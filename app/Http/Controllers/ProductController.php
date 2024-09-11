<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

//import return type view
use Illuminate\View\View;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Index
     * 
     * @return void
     */
    public function index() : View
    {
        //get all products
        // $products = Product::select("products.*", "category_product.product_category_name as product_category_name")
        //                   ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
        //                   ->latest()
        //                   ->paginate(10);

        $product = new Product;
        $products = $product->get_product()
                            ->latest()
                            ->paginate(10);

    //render view with products
    return view('products.index', compact('products'));
}
}