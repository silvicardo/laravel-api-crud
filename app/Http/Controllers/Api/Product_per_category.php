<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class Product_per_category extends Controller
{
    public function index($id){

      $productsWithCategory = Product::where('category_id',$id)->get();

      return response()->json($productsWithCategory);

    }
}
