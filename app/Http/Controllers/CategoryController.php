<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    private $category;
    
    function __construct() {
        $this->category = new Category();
    }
    
    function getCategories(){        
        return $this->category->all();//->orderBy('CategoryName');
    }
}
