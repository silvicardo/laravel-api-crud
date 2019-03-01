<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

  public function index(){

    $allCategories = Category::all();

    return response()->json($allCategories);
  }

  public function create(Request $request){

    $userData = $request->validate([
        'title' => 'required|max:20',
    ]);
    //
    // if (empty($userData['title'])) {
    //   return response()->json(['error' => 'No title provided']);
    // }

    $userData['slug'] =  Str::slug($userData['title']);

    $newCategory = new Category;
    $newCategory->fill($userData);
    $newCategory->save();

    return response()->json($newCategory);

  }

  public function show($id) {

    $category = Category::find($id);

    if (empty($category)) {
      return response()->json(['error' => 'Category id not valid']);
    }


    return response()->json($category);
  }

  public function update(Request $request, $id){

    $productToUpdate = Category::find($id);

    if(empty($productToUpdate)) {
        return response()->json(['error' => 'ID not found, operation failed']);
    }

    $userData = $request->validate([
        'title' => 'required|max:20',
    ]);

    $userData['slug'] =  Str::slug($userData['title']);

    $productToUpdate->update($userData);

    return response()->json($productToUpdate);

  }


  public function destroy($id) {

    $category = Category::find($id);

    if (empty($category)) {
      return response()->json(['error' => 'Category id not valid']);
    }

    $category->delete();

    return response()->json([]);

  }

}
