
<?php

        session_start();
        if(isset($_SESSION["admin_email"])!=""){
          require '../app/component/admin_interface.php';
        }else{
          require '../app/component/admin_login.php';
        }

?>