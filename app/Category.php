<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "bookcategories";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe
         'CategoryID','CategoryName'   
    ];
}
