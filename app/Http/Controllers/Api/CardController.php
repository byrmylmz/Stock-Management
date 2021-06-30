<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CardController extends Controller
{
    public function AddToCard(Request $Request,$id){
    	$product = DB::table('products')->where('id',$id)->first();
        $check=DB::table('pos')->where('pro_id',$id)->first();
        if($check){
            DB::table('pos')->where('pro_id',$id)->increment('pro_quantity');

            $product=DB::table('pos')->where('pro_id',$id)->first();
            $subtotal=$product->pro_quantity * $product->pro_price;
            $update=DB::table('pos')->where('pro_id',$id)->update(['sub_total'=>$subtotal]);

        }else{
            $data = array();
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['pro_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;
    
    
            DB::table('pos')->insert($data);

        }       
        }

    public function CardProduct(){
        $card=DB::table('pos')->get();
        return response()->json($card);
    }

    public function CardDelete(Request $Request, $id){
        $delete=DB::table('pos')->where('id',$id)->delete();

    }

    public function Increment($id){
        $increment=DB::table('pos')->where('id',$id)->increment('pro_quantity');

        $product=DB::table('pos')->where('id',$id)->first();
        $subtotal=$product->pro_quantity * $product->pro_price;
        $update=DB::table('pos')->where('id',$id)->update(['sub_total'=>$subtotal]);
        return response('Done');

    }
    public function Decrement($id){
        $decrement=DB::table('pos')->where('id',$id)->decrement('pro_quantity');

        $product=DB::table('pos')->where('id',$id)->first();
        $subtotal=$product->pro_quantity * $product->pro_price;
        $update=DB::table('pos')->where('id',$id)->update(['sub_total'=>$subtotal]);
        return response('Done');

    }

    public function Vats(){
        $vat=DB::table('extra')->first();
        return response()->json($vat);

    }

}
