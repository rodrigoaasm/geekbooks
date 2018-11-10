<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "bookdescriptions";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe        
        'title','description','price','publisher','pubdate','edition','pages',     
    ];
}
