<?php 
include_once("C:\wamp64\www\SISTEMAGESTIONASISTENCIA\Controller\controllerCredentials.php");
session_destroy();  

?>
<!DOCTYPE html>

<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina inicial</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <!-- <script type="text/javascript" src="js/jquery.js"></script>-->

    <body>
        <div class="container">
            <div class="login-container">
                <div id="output"></div>
                <span id="imagenlogin"></span>
                <h4>Bienvenido al sistema de biblioteca de la Universidad del valle</h4>                
                <div class="form-box">
                    <form action="" method="">
                        <input name="user" type="text" placeholder="username">
                        <input type="password" placeholder="password">
                        <!--<button class="btn btn-danger btn-block login" type="submit" id="btnLogin">Login</button>-->
                        <p><a class="btn btn-danger btn-block login" type="submit" id="btnLogin">Login</a></p>
                    </form>
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
            $("#btnLogin").click(function(){
                alert("hola");
                document.location.href="principal.php";
            });
        });
    </script>

</html> 