<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        CategoryResource::wrap('data');
        return CategoryResource::collection(Category::all());
    }
}
