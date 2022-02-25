<?php


namespace App\Http\Services\Product;

use App\Models\Product;

class ProductService
{
    const LIMIT = 12;
    const PRODUCTSBYCATE = 4;

    public function get($page = null){
        return Product:: select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->orderByDesc('id')
            ->when($page !=  null, function($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active',1)
            ->with('category')
            ->firstOrFail();
    }

    public function more($id)
    {
        $category = Product::select('category_id')->where('id', $id)->firstOrFail();
        $product_related = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->where('category_id', $category->category_id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
        return $product_related;
    }


    // public function getByPC($page = null){
    //     return Product:: select('id', 'name', 'price', 'price_sale', 'thumb')
    //         ->where('category_id', 1)
    //         ->where('hot', 1)
    //         ->where('active', 1)
    //         ->orderByDesc('id')
    //         ->when($page !=  null, function($query) use ($page) {
    //             $query->offset($page * self::PRODUCTSBYCATE);
    //         })
    //         ->limit(self::PRODUCTSBYCATE)
    //         ->get();
    // }

    // public function getByLaptop($page = null){
    //     return Product:: select('id', 'name', 'price', 'price_sale', 'thumb')
    //         ->where('category_id', 2)
    //         ->where('hot', 1)
    //         ->where('active', 1)
    //         ->orderByDesc('id')
    //         ->when($page !=  null, function($query) use ($page) {
    //             $query->offset($page * self::PRODUCTSBYCATE);
    //         })
    //         ->limit(self::PRODUCTSBYCATE)
    //         ->get();
    // }

    // public function getByManhinh($page = null){
    //     return Product:: select('id', 'name', 'price', 'price_sale', 'thumb')
    //         ->where('category_id', 4)
    //         ->where('hot', 1)
    //         ->where('active', 1)
    //         ->orderByDesc('id')
    //         ->when($page !=  null, function($query) use ($page) {
    //             $query->offset($page * self::PRODUCTSBYCATE);
    //         })
    //         ->limit(self::PRODUCTSBYCATE)
    //         ->get();
    // }

    // public function getByGear($page = null){
    //     return Product:: select('id', 'name', 'price', 'price_sale', 'thumb')
    //         ->where('category_id', 5)
    //         ->where('hot', 1)
    //         ->where('active', 1)
    //         ->orderByDesc('id')
    //         ->when($page !=  null, function($query) use ($page) {
    //             $query->offset($page * self::PRODUCTSBYCATE);
    //         })
    //         ->limit(self::PRODUCTSBYCATE)
    //         ->get();
    // }

}