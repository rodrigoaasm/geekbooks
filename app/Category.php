<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use DB;

class Category extends Model
{
    protected $table = "bookcategories";//Passando o nome da tabela categoria no banco
    
    protected $fillable = [//Campos da classe
         'CategoryID','CategoryName'   
    ];
    
    /*Método responsável por fazer a recuperação dos livros atraves de um codigo SQL*/
    public function books($catID){
        
        $objBooks =  DB::select('select `bookdescriptions`.*, `bookcategoriesbooks`.'
                . '`CategoryID` as `pivot_category_id`, `bookcategoriesbooks`.`'
                . 'ISBN` as `pivot_book_id` from `bookdescriptions` inner join '
                . '`bookcategoriesbooks` on `bookdescriptions`.`ISBN` = '
                . '`bookcategoriesbooks`.`ISBN` where  `bookcategoriesbooks`.'
                . '`CategoryID` = '.$catID.';');
        
        $books = array();//Instaciando array        
        foreach($objBooks as $objBook){
            $books[] = (array)$objBook;//fazendo o cast de objeto para array de cada registro retornado
        }        
        return $books;       
    }

}
