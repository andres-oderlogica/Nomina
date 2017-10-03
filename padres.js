function validar(id_estudiante,user)
{
$.ajax({  url: "bin/modules/boletines/credenciales.php",
              type: "POST",
              dataType: "json",
              data: {id_estudiante:id_estudiante,user:user}
          })
      .done(function(data) {
       if(data)
       {
        
       } 
       else
        { 
          alert("Usuario Invalido");
          location.href='login.php';

        }
            
    });

}

$(document).ready(function(){

var id_estudiante=$("#id_estudiante").val();
var user=$("#user").val();
   	
validar(id_estudiante,user);

$("#salir").click(function(){ 
location.href='login.php';

          
          

});



	});


	
