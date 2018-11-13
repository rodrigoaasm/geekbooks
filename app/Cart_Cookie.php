<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_Cookie extends Model {

    protected $fillable = [//Campos da classe        
        'ISBN', 'name', 'quantity', 'price', 'total',
    ];

    public function __construct() {
        
    }

    public function add_cart($book) {
        // If item already exists in cart, update quantity
        $cont = 0;
        $quantity = 1;
        foreach ($_SESSION['cart'] as $key => $item) :
            if ($item['ISBN'] == $book['ISBN']) {
                $quantity += $_SESSION['cart'][$cont]['quantity'];
                $this->update_cart($book['ISBN'], $quantity);
                return;
            }
            $cont ++;
        endforeach;

        $item = array(
            'name' => $book['title'],
            'price' => $book['price'],
            'quantity' => 1,
            'total' => $book['price'],
            'ISBN' => $book['ISBN']
        );
        $_SESSION['cart'][$cont + 1] = $item;
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

    public function delete_cart($isbn) {
        $cont = 0;
        foreach ($_SESSION['cart'] as $key => $item) :
            if ($item['ISBN'] == $isbn) {
                unset($_SESSION['cart'][$cont]);
            }
            $cont++;
        endforeach;
    }
    
    
    public function calc_frete(){
        $frete = 0;
        $cont = 0;
        foreach ($_SESSION['cart'] as $key => $item) :
            $cont += $item['quantity'];
        endforeach;
        if($cont >0){
            $frete = (5 * ($cont-1)) + 10;
        }
        return $frete;
    }
    
    public function subTotal(){
        $cont = 0;
        foreach ($_SESSION['cart'] as $key => $item) :
            $cont += $item['total'];
        endforeach;
        return $cont;
    }
}
