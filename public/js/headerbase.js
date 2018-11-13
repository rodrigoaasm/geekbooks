
$(document).ready(function(){    
    $('#title_page').click(openNav);    
    $('#closeMySideNav').click(closeNav);
});        

function openNav(){//Abrir sideNav        
    $("#mySidenav").width('70%');        
}

function closeNav(){//Fechar sidebar
   $("#mySidenav").width('0');    
}
