<?php

namespace App\Http\Controllers;

use Input,Config,Validator,Image;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    var $rp=2;
    public function __constuct(){
        $this->rp = Config::get('app.result_per_page');
    }
    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index',compact('products'));
    }
    public function search(){
        $query = Input::get('s');
            if($query){
                $products = Product::where('code','like','%'.$query.'%')
                ->orwhere('name','like','%'.$query.'%')
                ->orwhere('stock_qty','like','%'.$query.'%')
                ->paginate($this->rp);
            }
            else{
                $products = Product::paginate($this->rp);
            }
            return view('product/index',compact('products'));
    }
    public function edit($id=null){
        $category = Category::pluck('name','id')->prepend('เลือกรายการ','');

        if($id){
            $product = Product::where('id',$id)->first();
            return view('product/edit')
                ->with('product',$product)
                ->with('category',$category);
        }
        else{
            return view('product/add')
            ->with('category',$category);

        }
        // $product = Product::find($id);
        //     return view('product/edit')
        //         ->with('product',$product)
        //         ->with('category',$category);
    }   
    public function update(){
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = Input::get('id');
        $Validator = Validator::make(Input::all(), $rules,$messages);
        if($Validator->fails()){
            return redirect('product/edit/'.$id)
            ->withErrors($Validator)
            ->withInput();
        }

        $product = Product::find($id);
        $product->code = Input::get('code');
        $product->name = Input::get('name');
        $product->category_id = Input::get('category_id');
        $product->price = Input::get('price');
        $product->stock_qty = Input::get('stock_qty');
        $product->save();

        if(Input::hasFile('image')){
            $f = Input::file('image');
            $upload_to = 'upload/images';
            //get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            //upload
            $f->move($absolute_path, $f->getClientOriginalName());
            //Image_resize
            Image::make(public_path().'/'.$relative_path)->resize(150,150)->save();
            //save in database
            $product->image_url = $relative_path;
            $product->save();
        }


        return redirect('product')
            ->with('ok',true)
            ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');

    }
    public function insert(){
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = Input::get('id');
        $Validator = Validator::make(Input::all(), $rules,$messages);
        if($Validator->fails()){
            return redirect('product/edit/'.$id)
            ->withErrors($Validator)
            ->withInput();
        }
        $product = new Product();
        $product->code = Input::get('code');
        $product->name = Input::get('name');
        $product->category_id = Input::get('category_id');
        $product->price = Input::get('price');
        $product->stock_qty = Input::get('stock_qty');

        if(Input::hasFile('image')){
            $f = Input::file('image');
            $upload_to = 'upload/images';
            //get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            //upload
            $f->move($absolute_path, $f->getClientOriginalName());
            //Image_resize
            Image::make(public_path().'/'.$relative_path)->resize(150,150)->save();
            //save in database
            $product->image_url = $relative_path;
            $product->save();
        }

        $product->save();

        return redirect('product')
            ->with('ok',true)
            ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว');


    }
    public function remove($id){
        Product::find($id)->delete();

        return redirect('product')
            ->with('ok',true)
            ->with('msg','ลบข้อมูลสำเร็จ');
    }

}
