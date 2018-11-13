<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {
    
    private $categoryCtr;
    
    function __construct() {
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
    }

    public function show() {
        $categories = $this->categoryCtr->getCategories();
        $title_body ="Cart";
        return view("cart_view/cart_view",compact("categories", "title_body"));
    }

}
