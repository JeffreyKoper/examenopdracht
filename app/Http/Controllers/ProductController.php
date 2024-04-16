<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function productspage()
  {
    $count = Products::where('stock', '>', 0)->count();
    $products = Products::where('stock', '>', 0)->simplepaginate(20);
    $categories = $this->getCategories(); // Add this line
    $sizes = $this->getSizes(); // Add this line
    return view('products', ['products' => $products, 'categories' => $categories, 'sizes' => $sizes, 'count' => $count]);
  }

  public function singleProduct($id)
  {
    $data = Products::find($id);
    $reviewData = Reviews::join('users', 'reviews.user_id', '=', 'users.id')
      ->where('reviews.product_id', $id)
      ->select('reviews.*', 'users.name as user_name')
      ->get();
    return view('product', ['data' => $data, 'reviewData' => $reviewData]);
  }

  public function search(Request $request)
  {
    $query = $request->input('query');
    $category = $request->input('category');
    $size = $request->input('size');

    $productsQuery = Products::where('stock', '>', 0);

    if ($query) {
      $productsQuery->where('product_name', 'like', '%' . $query . '%');
    }

    if ($category) {
      $productsQuery->where('category', $category);
    }
    if ($size) {
      $productsQuery->where('size', $size);
    }
    $productCount = $productsQuery->count();
    $data = $productsQuery->simplePaginate(20);

    // Pass the categories to the view as well
    $categories = $this->getCategories();
    $sizes = $this->getSizes();

    return view('products', ['products' => $data, 'categories' => $categories, 'sizes' => $sizes, 'count' => $productCount]);
  }
  private function getCategories()
  {
    // Fetch unique categories from the database
    return DB::table('products')->distinct()->pluck('category');
  }
  private function getSizes()
  {
    // Fetch unique categories from the database
    return DB::table('products')->distinct()->pluck('size');
  }
}
