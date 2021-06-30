<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Supplier;
use DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        
        if ($request->photo){
            $position=strpos($request->photo,';');
            $sub=substr($request->photo,0,$position);
            $ext=explode('/',$sub)[1];

            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(40,40);
            $upload_path= 'backend/supplier/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $supplier=new Supplier;
            $supplier->name=$request->name;
            $supplier->phone=$request->phone;
            $supplier->authority=$request->authority;
            $supplier->city=$request->city;
            $supplier->district=$request->district;
            $supplier->adress=$request->adress;
            $supplier->iban=$request->iban;
            $supplier->balance=$request->balance;
            $supplier->balance_type=$request->balance_type;
            $supplier->due_date=$request->due_date;
            $supplier->photo=$image_url;
            $supplier->save();
        }else{
            $supplier=new Supplier;
            $supplier->name=$request->name;
            $supplier->phone=$request->phone;
            $supplier->authority=$request->authority;
            $supplier->city=$request->city;
            $supplier->district=$request->district;
            $supplier->adress=$request->adress;
            $supplier->iban=$request->iban;
            $supplier->balance=$request->balance;
            $supplier->balance_type=$request->balance_type;
            $supplier->due_date=$request->due_date;
            $supplier->photo=$request->photo;
            $supplier->save();

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['phone']=$request->phone;
        $data['authority']=$request->authority;
        $data['city']=$request->city;
        $data['district']=$request->district;
        $data['adress']=$request->adress;
        $data['iban']=$request->iban;
        $data['balance']=$request->balance;
        $data['balance_type']=$request->balance_type;
        $data['due_date']=$request->due_date;
        $image=$request->newphoto;

        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
   
            $name = time().".".$ext;
            $img = Image::make($image)->resize(40,40);
            $upload_path = 'backend/supplier/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);
            
            if($success){
                $data['photo']=$image_url;
                $img=DB::table('suppliers')->where('id',$id)->first();
                $image_path=$img->photo;
                if($image_path){
                    unlink($image_path);
                }else{

                }
            $user=DB::table('suppliers')->where('id',$id)->update($data);
            }
        }else{
            $oldphoto= $request->photo;
            $data['photo']=$oldphoto;
            $user=DB::table('suppliers')->where('id',$id)->update($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=DB::table('suppliers')->where('id',$id)->first();
        $photo=$supplier->photo;
        if($photo){
            unlink($photo);
            DB::table('suppliers')->where('id',$id)->delete();
        }else{
            DB::table('suppliers')->where('id',$id)->delete();
        }

    }
}
