<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    private $category;
    
    function __construct() {
        $this->category = new Category();
    }
    
    function getCategories(){ 
        
        $objCats =  DB::select('select DISTINCT `bookcategories`.* from `bookcategories`'
                . ' RIGHT JOIN `bookcategoriesbooks` on `bookcategories`.`CategoryID` = '
                . '`bookcategoriesbooks`.`CategoryID`;');
        
        $cats = array();//Instaciando array        
        foreach($objCats as $objCat){
            $cats[] = (array)$objCat;//fazendo o cast de objeto para array de cada registro retornado
        }        
        return $cats;         
       
    }
    
    function getCategory($id){
        return  $this->category->where("CategoryID",$id)->first();
    }
    
    
}
