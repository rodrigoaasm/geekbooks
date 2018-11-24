<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model {

    protected $table = "bookorders"; //Passando o nome da tabela order no banco
    public $timestamps = false;
    protected $fillable = [
        'orderID', 'custID', 'orderdate'//Campos da classe   
    ];

}
