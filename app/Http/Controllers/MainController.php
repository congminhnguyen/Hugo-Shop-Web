<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{

    protected $slider;
    protected $category;

    public function __construct(SliderService $slider, CategoryService $category)
    {
        $this->slider = $slider;
        $this->category = $category;
    }

    public function index(){
        return view('main', [
            'title' => 'Hugo Shop',
            'sliders' => $this->slider->show(),
            'categories' => $this->category->show()
        ]);
    }
}
