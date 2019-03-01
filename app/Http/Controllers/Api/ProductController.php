<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ProductController extends Controller
{

  public function index(){

    $allProducts = Product::all();

    return response()->json($allProducts);

  }

  public function create(Request $request){

    $userData = $request->validate([
        'name' => 'required|max:30',
        'description' => 'required',
        'quantity' => 'required',
        'category_id' => 'required'
    ]);

    if(empty(Category::find($userData['category_id']))){
      return response()->json(['error' => 'category at id does not exists']);
    }

    $newProduct = new Product;
    $newProduct->fill($userData);
    $newProduct->save();

    return response()->json($newProduct);

  }

  public function show($id) {

    $product = Product::find($id);

    if (empty($product)) {
      return response()->json(['error' => 'Product id not valid']);
    }

    return response()->json($product);

  }

  public function update(Request $request, $id){

    $userData = $request->all();

    if ((empty($userData['name'])) &&
        (empty($userData['description'])) &&
        (empty($userData['quantity']) &&
        (empty($userData['category_id'])))
      ) {
      return response()->json(['error' => 'Missing update data']);
    }

    if(empty(Category::find($userData['category_id']))){
      return response()->json(['error' => 'category at id does not exists']);
    }

    $productToUpdate = Product::find($id);

    if(empty($productToUpdate)) {
        return response()->json(['error' => 'ID not found, operation failed']);
    }

   $productToUpdate->update($userData);

   return response()->json($productToUpdate);

  }

  public function destroy($id) {

    $product = Product::find($id);

    if (empty($product)) {
      return response()->json(['error' => 'Product id not valid']);
    }

    $product->delete();

    return response()->json([]);

  }

}
