<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Book;
use App\Category;


class BookController extends Controller
{    
    
    private $categoryCtr;
    private $book;
    
    function __construct(Book $book) {
        $this->book = $book;
        $this->categoryCtr = new CategoryController();//Instancia Controlador de categorias
    }
    
    
    public function byCategory($catID = null){       
        $categories = $this->categoryCtr->getCategories();//recuperando categorias
        
        
        if($catID == null){//Se não tiver nenhuma categoria selecionada coloca todas na tela
           $books = $this->book->all();
        }else{//buscando livros por categoria
            $category = $this->categoryCtr->getCategory($catID); //Recuperando categoria selecionada;            
            $books = $category->books($catID);//Recuperando os livros por categoria           
        }
        
        return view("books_view/books_view",compact("categories","books","catID"));
    }
    
    
    public function bySearch(Request $request){        
        $post = $request->except('_token');//Recuperando informações passadas via post
        $categories = $this->categoryCtr->getCategories();//recuperando categorias
        
        $keyWord = $post['search_books'];
        $books = $this->book->where('title','LIKE','%'.$keyWord.'%')->get();

        return view("books_view/books_view",compact("categories","books","keyWord"));
    }
}
