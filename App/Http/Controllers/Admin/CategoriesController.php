<?php


namespace App\Http\Controllers\Admin;


use App\Http\Functions\BladeEngine;
use App\Http\Models\Category;

class CategoriesController
{

    public function index()
    {
        $categories = Category::all();
        echo BladeEngine::View("Pages.Backend.Categories.index",["categories"=>$categories]);
    }

}