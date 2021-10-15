<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Str; cho Str::slug

class CategoryService{

    public function getParent(){
        return Category::where('parent_id',0)->get();
    }

    public function create($request){
        try{
            Category::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (string)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active'),
                // 'slug' => Str::slug($request->input('name'),'-')
            ]);
            Session::flash('success','Successfully inserted');
        } 
        catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
}