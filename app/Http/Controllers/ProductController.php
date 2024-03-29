<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Reviews;
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
    $review_data = Reviews::join('users', 'reviews.user_id', '=', 'users.id')
                           ->where('reviews.product_id', $id)
                           ->select('reviews.*', 'users.name as user_name')
                           ->get();
    return view('product', ['data' => $data, 'review_data' => $review_data]);
}

}
