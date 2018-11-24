<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Db;

class OrderItem extends Model {

    protected $table = "bookorderitems"; //Passando o nome da tabela orderitems no banco
    public $timestamps = false;
    protected $fillable = [
        'orderID', 'ISBN', 'qty', 'price'//Campos da classe   
    ];

}
