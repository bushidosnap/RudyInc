<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderProduct;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function changeStatus(Request $request){

        try{
            $order_id = $request->post('order_id');
            $order = Order::findOrFail($order_id);

            if($order->status == 1){
                $order->status = 2;
            }else if($order->status == 2){
                $order->status = 3;
            }else if($order->status == 3){
                $order->status = 4;
            }
            $order->save();
            return response()->json(['success', $order->status]);

        }catch(Exception $e){
            return response($e->getMessage(),400);
        }

    }

    public function showProducts(Request $request){
        
        try{
            $order_id = $request->post('order_id');
            $orderProduct = OrderProduct::join('products','products.id', 'product_id')
                                            ->where('order_id',$order_id)->get();
            //return response()->json($orderProduct);
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            $i = 1;
            foreach($orderProduct as $row)
            {

                $output .= '
                <li><strong>Item No. '.$i.'</strong></li>
                <li>'.$row->name.' - '.$row->description.'</li>
                <li>'.$row->price.' - '.$row->category.'</li>
                ';
                $i++;
            }
                $output .= '</ul>';
                echo $output;

        }catch(Exception $e){
            return response($e->getMessage(),400);
        }

    }
}
