<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of HistoryAcess
 *
 * @author Rodrigo Maia
 */
class HistoricalAccessElement {
    //put your code here 
    const PAGE_ORDER = '0';
    const PAGE_CATEGORY = '1';
    const PAGE_SEARCH = '2';    
    const PAGE_BOOK = '3';
    const PAGE_CART= '4';

    private $page,$link,$title,$hierc;
    
    public function __construct($aPage,$aLink,$aTitle) {
        $this->page = $aPage;
        $this->link = $aLink;
        $this->title = $aTitle;
       
        //defini valor hieratico do elemento historico
        if($aPage == $this::PAGE_CATEGORY or $aPage == $this::PAGE_SEARCH
                or $aPage == $this::PAGE_ORDER){
            $this->hierc = 1;
        }else if($aPage == $this::PAGE_BOOK){
            $this->hierc = 2;
        }else if($aPage == $this::PAGE_CART){
            $this->hierc = 3;
        } 
    }
    
    function getLink() {
        return $this->link;
    }

    function getTitle() {
        return $this->title;
    }
        
    public function getHierc() {
        return $this->hierc;
    }



}
