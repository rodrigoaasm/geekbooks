<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = "bookauthors";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe        
        'AuthorID','nameF','nameL',     
    ];    
    protected $primaryKey = 'AuthorID';
}
