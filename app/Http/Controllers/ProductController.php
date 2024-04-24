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
    $categories = $this->getCategories();
    $sizes = $this->getSizes();
    $genders = $this->getGenders();
    return view('products', ['products' => $products, 'categories' => $categories, 'sizes' => $sizes, 'count' => $count, 'genders' => $genders]);
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
    $gender = $request->input('gender');

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
    if ($gender) {
      $productsQuery->where('variant', $gender);
    }
    $productCount = $productsQuery->count();
    $data = $productsQuery->simplePaginate(20);

    // Pass the categories to the view as well
    $categories = $this->getCategories();
    $sizes = $this->getSizes();
    $genders = $this->getGenders();

    return view('products', ['products' => $data, 'categories' => $categories, 'sizes' => $sizes, 'count' => $productCount, 'genders' => $genders]);
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
  private function getGenders()
  {
    return DB::table('products')->distinct()->pluck('variant');
  }
}
