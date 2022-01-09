<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categroyService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categroyService = $categoryService;
    }

    public function index(Request $request, $id, $slug){
        $category = $this->categroyService->getId($id);

        $products = $this->categroyService->getProduct($category, $request);
        
        return view('category', [
            'title' => $category->name,
            'products' => $products,
            'category' => $category
        ]);
    }
    
}
