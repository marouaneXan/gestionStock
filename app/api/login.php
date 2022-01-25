


<?php

    session_start();
    require_once '../classes/db.php';
    require_once '../classes/admin.php';
    $admin=new Admin();


   function login(){
     if(empty($_POST["email-login"])){
         echo '<div  style="color:white;background-color:#F55347;width:100%;text-align:center;padding:10px;">Entrer votre email</div>';
         
     }elseif(empty($_POST["password-login"])){
        echo '<div  style="color:white;background-color:#F55347;width:100%;text-align:center;padding:10px;">Entrer votre mot de passe</div>';

    }else{
        if($GLOBALS["admin"]->getAdminLogin($_POST["email-login"],$_POST["password-login"])){
            $_SESSION["admin_email"]=$_POST["email-login"];
            echo "sussecc";
        
        }else{
          echo '<div  style="color:white;background-color:#F55347;width:100%;text-align:center;padding:10px;">Votre mot de passe ou e-mail non valide</div>';

        }
    }
   }



   
   if(isset($_POST["actionLogin"])=="login"){
       login();
   }



?>