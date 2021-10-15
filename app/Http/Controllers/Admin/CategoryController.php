<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(){
        return view('admin.category.add', [
            'title'=>'Add new category',
            'categories'=>$this->categoryService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){
        $result = $this->categoryService->create($request);
        return redirect()->back();
    }
}
