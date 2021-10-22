<?php


namespace App\Http\Services\Product;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class ProductAdminService 
{
    public function getMenu()
    {
        return Category::where('active', 1)->get();
    }

    public function get(){
        return Product::with('category')->orderByDesc('id')->paginate(15);
    }

    protected function isValidPrice($request){
        if($request->input('price') != 0 
            &&  $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price'))
        {
            Session::flash('error', 'Price_sale must be less than Price');
            return false;
        }

        if($request->input('price_sale') != 0 && $request->input('price') == 0 ){
            Session::flash('error', 'Please enter Price');
            return false;
        }
        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }
        try{
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success', 'Add new product successfully');
        }
        catch(\Exception $err){
            Session::flash('error', 'Add new product fail');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $product){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }
        try{
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Updated Successfully');
        }catch(Exception $err){
            Session::flash('error', 'Update fail');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){   
        $id = $request->input('id');
        $product = Product::where('id', $id)->first();
        if($product){
            return Product::where('id', $id)->delete();
        }
        return false;
    }
}