<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //public static $wrap = 'products';

    public function index()
    {
        $products = Product::all();
        return $products;
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

    public function getByCategories($category_id){
        $products=Product::get()->where('category_id',$category_id);
        return $products;
    }

    public function getByUsers($user_id){
        $products=Product::get()->where('user_id',$user_id);
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'product_name'=>'required|String|max:255',
            'description'=>'required|String',
            'price'=>'required|Integer|max:40',
            'category_id'=>'required',
            'user_id'=>'required',
            'ingredients'=>'required|String',


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $products=new Product;
        $products->product_name=$request->product_name;
        $products->description=$request->description;
        $products->price=$request->price;
        $products->category_id=$request->category_id;
        $products->user_id=Auth::user()->id;
        $products->ingredients=$request->ingredients;

        $products->save();

        return response()->json(['Product is saved successfully!',new ProductResource($products)]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function show($product_id)
    // {
    //     $products=Product::get()->where('id',$product_id);
    //     return $products;
    // }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator=Validator::make($request->all(),[
            'product_name'=>'required|String|max:255',
            'description'=>'required|String',
            'price'=>'required|Integer|max:40',
            'category_id'=>'required',
            'user_id'=>'required',
            'ingredients'=>'required|String',


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $product->product_name=$request->product_name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->user_id=Auth::user()->id;
        $product->ingredients=$request->ingredients;
        $result=$product->update();

         if($result==false){
             return response()->json('Difficulty with updating!',$product);
        }
        return response()->json(['Product is updated successfully!',new ProductResource($product)]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json('Product is deleted successfully!');
    }

    public function myProduct(Request $request){
        $products=Product::get()->where('user_id',Auth::user()->id);
        if(count($products)==0){
            return 'You do not have saved product!';
        }
        $my_product=array();
        foreach($products as $products){
            array_push($my_product,new ProductResource($products));
        }

        return $my_product;
    }
}
