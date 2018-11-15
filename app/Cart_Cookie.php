<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cookie;
use Response;
use Illuminate\Http\Request;

class Cart_Cookie extends Model {
    
    private $cookie_name = 'cart';
    private $time = 600000 * 10;

    public function add_cart($isbn) {
        // If item already exists in cart, update quantity
        $bookArray = Array();
        if (isset($_COOKIE['cart'])) {
            $bookArray = unserialize($_COOKIE['cart']);
            if (isset($bookArray[$isbn])){
                $bookArray[$isbn] += 1;
            }else{
                $bookArray[$isbn] = 1;
            }
            setcookie($this->cookie_name, serialize($bookArray), time() + $this->time, '/geekbooks/public/cart/');
        }else {
            $bookArray[$isbn] = 1;
            setcookie($this->cookie_name, serialize($bookArray), time() + $this->time, '/geekbooks/public/cart/');
        }
        return $bookArray;
    }

    public function update_cart($isbn, $quant) {
        $quantity = (int) $quant;
        $cont = 0;
        foreach ($_SESSION['cart'] as $key => $item) :
            if ($item['ISBN'] == $isbn) {
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$cont]);
                } else {
                    $_SESSION['cart'][$cont]['quantity'] = $quantity;
                    $total = $_SESSION['cart'][$cont]['price'] *
                            $_SESSION['cart'][$cont]['quantity'];
                    $_SESSION['cart'][$cont]['total'] = $total;
                }
            }
            $cont++;
        endforeach;
    }

    public function delete_cart($book) {
        $bookArray = unserialize($_COOKIE['cart']);
        foreach ($bookArray as $isbn => $qty) :
            if($isbn == $book){
                unset($bookArray[$isbn]);
                setcookie($this->cookie_name, serialize($bookArray), time() + $this->time, '/geekbooks/public/cart/');
            }
        endforeach;
        return $bookArray;
    }

}
