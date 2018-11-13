<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Cart_Cookie;


class CartController extends Controller {

    private $categoryCtr;
    private $book;
    private $cartCookie;
    // Start session management with a persistent cookie
    private $lifetime = 60 * 5;    // 5 minutos;

    function __construct(Book $book) {
        $this->book = $book;
        $this->categoryCtr = new CategoryController(); //Instancia Controlador de categorias
        $this->cartCookie = new Cart_Cookie(); 
        session_set_cookie_params($this->lifetime, '/');
        session_start();

        // Create a cart array if needed
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    public function show($isbn = null) {
        $categories = $this->categoryCtr->getCategories();
        $title_body = "Cart";
        if ($isbn) {
            $book = $this->book->where('ISBN', $isbn)->first();
            $book["description"] = htmlspecialchars($book["description"]);
            $this->cartCookie->add_cart($book);
            
        }
        $subTotal = $this->cartCookie->subTotal();
        $frete = $this->cartCookie->calc_frete();
        $totalCart = $frete+ $subTotal;
        return view("cart_view/cart_view", compact("categories", "subTotal", "frete", "totalCart", "title_body"));
    }

}
