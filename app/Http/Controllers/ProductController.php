<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  // Display products page with pagination
  public function productspage()
  {
    $count = Products::where('stock', '>', 0)->count();
    $products = Products::where('stock', '>', 0)->simplepaginate(20);
    $categories = $this->getCategories();
    $sizes = $this->getSizes();
    $genders = $this->getGenders();
    return view('products', ['products' => $products, 'categories' => $categories, 'sizes' => $sizes, 'count' => $count, 'genders' => $genders]);
  }

  // Display single product details along with reviews
  public function singleProduct($id)
  {
    $data = Products::find($id);
    $reviewData = Reviews::join('users', 'reviews.user_id', '=', 'users.id')
      ->where('reviews.product_id', $id)
      ->select('reviews.*', 'users.name as user_name')
      ->get();
    return view('product', ['data' => $data, 'reviewData' => $reviewData]);
  }

  // Search for products based on query, category, size, and gender
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

  // Get unique product categories
  private function getCategories()
  {
    // Fetch unique categories from the database
    return DB::table('products')->distinct()->pluck('category');
  }

  // Get unique product sizes
  private function getSizes()
  {
    // Fetch unique sizes from the database
    return DB::table('products')->distinct()->pluck('size');
  }

  // Get unique product genders
  private function getGenders()
  {
    // Fetch unique genders from the database
    return DB::table('products')->distinct()->pluck('variant');
  }

  public function create(Request $request)
  {
    $product = new Products();
    $product->product_name = $request->productName;
    $product->description = $request->productDescription;
    $product->excerpt = $request->productExcerpt;
    $product->img_filepath = $request->productImg_filepath;
    $product->price = $request->productPrice;
    $product->size = $request->productSize;
    $product->variant = $request->productVariant;
    $product->stock = $request->productStock;
    $product->category = $request->productCategory;
    $product->save();
    return redirect()->route('products.show');
  }
  public function allProductsDashboard()
  {
    $products = Products::simplePaginate(30);
    return view('products.show', ['product_data' => $products]);
  }
  public function editForm($id)
  {
    $product = Products::findOrFail($id);
    $categories = $this->getCategories();
    return view('products.edit', compact('product'), compact('categories'));
  }
  public function updateProduct(Request $request, $id)
  {
    $product_data = Products::findOrFail($id);

    $request->validate([
      'productName' => 'required|string',
      'productDescription' => 'required|string',
      'productExcerpt' => 'required|string',
    ]);

    $product_data->product_name = $request->productName;
    $product_data->description = $request->productDescription;
    $product_data->excerpt = $request->productExcerpt;
    $product_data->img_filepath = $request->productImg_filepath;
    $product_data->price = $request->productPrice;
    $product_data->size = $request->productSize;
    $product_data->variant = $request->productVariant;
    $product_data->category = $request->productCategory;

    $product_data->save();

    return redirect()->route('products.show')->with('success', 'Product updated successfully.');
  }
  public function delete($id)
  {
    try {
      // Delete the promotion without foreign key constraint checks
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Products::where('id', $id)->delete();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      // Redirect the product back to the promotions page
      return redirect()->route('products.show')->with('success', 'Product deleted successfully.');
    } catch (\Exception $e) {
      // Handle any exceptions or errors
      return redirect()->route('products.show')->with('error', 'An error occurred while deleting the Product.');
    }
  }
  public function showCreate()
  {
    $categories = $this->getCategories();
    return view('products.create', compact('categories'));
  }
}
