<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Str;
use App\Http\Requests\CreateOrderRequest;


class TailorController extends Controller
{

  public function __construct(){
      $this->middleware('auth');
  }

  Function index(){
    return view('tailor-create');
  }

  public function createOrder(CreateOrderRequest $request)
  {

    $client_email = Str::of($request->input('client_name'))->before(',');
    $size = count(collect($request->input('name')));

    $getProdId = array();
    $getTotal = array();
    $getQty = array();
    $subtotal = 0;
    //inserting all product
    for ($i = 0; $i < $size; $i++)
    {
      $prodAdd = new Product;
      $prodAdd->name = $request->get('name')[$i];
      $prodAdd->description = $request->get('description')[$i];
      $prodAdd->price = $request->get('price')[$i];
      $prodAdd->category = $request->get('category')[$i];
      $prodAdd->save();
      $subtotal =  (int)$request->get('price')[$i] * (int)$request->get('qty')[$i];
      $getQty[] = $request->get('qty')[$i];
      $getTotal[] = $subtotal;
      $getProdID[] = $prodAdd->id;
    }

    //inserting the order
    $orderAdd = new Order;
    $orderAdd->tailor_id = $request->input('tailor_id');
    $orderAdd->client_email = $client_email;
    $orderAdd->date_finish = $request->get('date_finish');
    $orderAdd->total_bill = array_sum($getTotal);
    $orderAdd->status = $request->get('status');
    $orderAdd->save();
    $orderID = $orderAdd->id;

    //inserting to the pivot table
    

    foreach(array_combine($getProdID, $getQty) as $key => $value)
    {
      $orderProdPivot = new OrderProduct;
      $orderProdPivot->order_id = $orderID;
      $orderProdPivot->product_id = $key;
      $orderProdPivot->quantity = $value;
      $orderProdPivot->save();
    }

    // $pivotSize = count($getProdID);
    // for($j = 0; $j < $pivotSize; $j++)
    // {

    // }

   return redirect()->route('profiles.show', [$request->input('tailor_id')])->with('success', 'Transaction created Successfully.');


    //totalbill logic
    
    
    
    
  }
}
