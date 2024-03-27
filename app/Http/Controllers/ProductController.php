<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function productspage()
  {
    $products = Products::all();
    return view('products', ['products' => $products]);
  }

  public function singleProduct($id)
  {
    $data = Products::find($id);
    
    return view('product', ['data' => $data]);
  }
}
