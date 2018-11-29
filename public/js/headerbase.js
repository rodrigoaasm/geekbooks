
$(document).ready(function(){    
    $('#title_page').click(openNav);    
    $('#closeMySideNav').click(closeNav);
    $('#dropdown-side').click(function(){
        $('#dropdown-side-menu').css('display', 'block');
    });
});        

function openNav(){//Abrir sideNav        
    $("#mySidenav").width('80%');        
}

function closeNav(){//Fechar sidebar
   $("#mySidenav").width('0');    
   $('#dropdown-side-menu').css('display', 'none');
}


