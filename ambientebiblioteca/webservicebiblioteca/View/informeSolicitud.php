<!DOCTYPE html>
<html lang="en">
   <html>
      <head> 
         <meta charset="UTF-8">
         <title>Disponibilidad</title>
         <link rel="stylesheet" type="text/css" href="css/style.css"/>
         <meta name="viewport" content="width=device-width, initial-scale=1">

         <link rel='stylesheet' type='text/css' href='../css/style.css'/>
         <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
         <script src='https://code.jquery.com/jquery.js'></script>
        <script src='bootstrap/js/bootstrap.min.js'></script>

      </head>
      <!-- <script type="text/javascript" src="js/jquery.js"></script>-->
      <body>
         <div class="container">
            <nav class='navbar navbar-inverse' role='navigation'>
               <div class='container-fluid'>
                  <div class='navbar-header'>
                     <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#acolapsar'>
                     <span class='sr-only'>Toggle navigation</span>
                     <span class='icon-bar'></span>
                     <span class='icon-bar'></span>
                     <span class='icon-bar'></span>
                     </button>
                     <a href='#' class='navbar-brand'>Mi proyect</a>
                  </div>
                  <div class='collapse navbar-collapse' id='acolapsar'>
                     <ul class='nav navbar-nav'>
                        <li><a href='principal.php'><span class='glyphicon glyphicon-home'></span>Inicio</a></li>
                        <li class='dropdown'>
                           <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-cog'>Informes<b class='caret'></b></a>
                           <ul class='dropdown-menu'>
                              <li><a href='informeDisponibilidad.php'>Disponibilidad</a></li>
                              <li><a href='informeSolicitud.php'>Solicitud</a></li>
                              <li><a href='informeTiquete.php'>Tiquete</a></li>
                           </ul>
                        </li>
                     </ul>
                     <ul class='nav navbar-nav navbar-right'>
                        <li><a href='#'>Usuario</a></li>
                        <li class='dropdown'>
                           <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Log Out<span class='caret'></span></a>
                           <ul class='dropdown-menu'>
                              <li><a href='#'>cerrar perfil</a></li>
                              <li role='separator' class='divider'></li>
                              <li><a href='#'>cerrar sesión</a></li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">Detalle</h3>
               </div>
               <div class="panel-body" id="listanovedad">
               </div>
            </div>
         </div>
      </body>

        <script src='https://code.jquery.com/jquery.js'></script>
        <!--<script src="jquery-3.2.1.min.js"></script>-->
        <script src='https://code.jquery.com/jquery-1.10.1.min.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script type="text/javascript">
            $('document').ready(function(){
                
              $.post( "../Controller/TbBibliotecaController.php",
              {
                modulo: "informe",
                componente: "listarSolicitud"
              },
              function(data,status){
                  //alert("Data: " + data + "\nStatus: " + status);
                  $("#listanovedad").html(data);
              });

            });
        </script>
   </html>