<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        $myType = Auth::user()->type;
        if($myType == 'tailor')
        {
            $myID = Auth::user()->id;
            // $orderProductShow = DB::table('order_product')
            //                     ->join('orders', 'orders.id', 'order_id')
            //                     ->join('products', 'products.id', 'product_id')
            //                     ->join('users', 'users.id', 'orders.tailor_id')
            //                     ->select('products.name as prod_name','products.description','products.price',
            //                     'orders.client_email','orders.date_finish','orders.total_bill','orders.status',
            //                     'users.name as user_name', 'order_product.quantity')
            //                     ->where('orders.tailor_id',$myID)
            //                     ->get();

            $tailorShow = DB::table('orders')
                        ->where('tailor_id',$myID)
                        ->get();

            return view('profiles.index', compact('user'))
            ->with('tailorShow',$tailorShow);
            // ->with('orderProductShow', $orderProductShow);

        }else{
            $myemail = Auth::user()->email;
            // $orderProductShow = DB::table('order_product')
            //                     ->join('orders', 'orders.id', 'order_id')
            //                     ->join('products', 'products.id', 'product_id')
            //                     ->select('products.*', 'orders.*', 'order_product.quantity')
            //                     ->groupBy('order_id')
            //                     ->get();
            $customerShow = DB::table('users')
                                ->join('orders', 'orders.tailor_id', 'users.id')
                                ->where('orders.client_email', $myemail)
                                ->get();
            
                                // $customerShow = DB::table('orders')
            //                     ->where('client_email',$myemail)
            //                     ->get();
            return view('profiles.index', compact('user'))
            ->with('customerShow',$customerShow);
            // ->with('orderProductShow', $orderProductShow);
        }
        

    }

    //for testing join in db
    public function show()
    {
        $myID = Auth::user()->id;
        return DB::table('order_product')
            ->join('orders', 'orders.id', 'order_id')
            ->where('orders.tailor_id',$myID)
            ->get();
    }

    public function edit(User $user){

        return view('profiles.edit', compact('user'));

    }

    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'gender' => 'required',
            'address' => 'required',
            'contact1' => 'required',
            'contact2' => 'required',
            'date_of_birth' => 'required|before_or_equal:2010/12/30',
            'image' => '',
        ]);
        
        if ($request->hasFile('image')){

            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');

        }
        

        auth()->user()->profile()->update(array_merge(
            $data,
            ['image' => $filename]
        ));


        return redirect("/profile/{$user->id}");
    }

}
