
<?php

    require_once '../app/classes/db.php';
    require_once '../app/classes/admin.php';

    $admin=new Admin();
    /*
    *
    *   get admin
    * 
    */
    $adminInfo=$admin->getAdmin();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="sass/admin/admin.css">
    <script src="jquery/jquery.3.5.1.js"></script>
  
</head>
<body>

     <header>
        <img src="images/menu.svg" class="toggle-menu"  width="50" height="50" alt="">
       <a href="?profile"><img  src=<?php if(!empty($adminInfo["image"])){ echo "upload/".$adminInfo["image"]; }else{echo "images/clientLogo.png";} ?> width="50" height="50" alt=""></a>
       <img src="images/ourLogo.svg" class="our-logo" width="50" height="50" alt="">
       <button><a href="../app/component/logout.php">Déconnexion</a></button>
     </header>  
     <div class="page">
        <aside>
            <h1><a  href="?dashboard">Dashboard</a></h1>
            <nav>
                <ul>
                    <li   <?php if(isset($_GET["dashboard"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?> > <img src="images/dashboard.svg" width="20" height="20" alt=""><a  href="?dashboard" <?php if(isset($_GET["dashboard"])) { echo "style='color:#FF7878;'"; }?>>Dashboard</a></li>
                    <li   <?php if(isset($_GET["produit"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?> > <img src="images/produit.png" width="20" height="20" alt=""><a  href="?produit" <?php if(isset($_GET["produit"])) { echo "style='color:#FF7878;'"; }?>>Liste des produits</a></li>
                    <li   <?php if(isset($_GET["ajouter"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?>> <img src="images/ajouterProduit.png" width="20" height="20" alt=""><a  href="?ajouter" <?php if(isset($_GET["ajouter"])) { echo "style='color:#FF7878;'"; }?> >Ajouter un produit</a></li>           
                    <li   <?php if(isset($_GET["domande"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?>> <img src="images/demande.png" width="20" height="20" alt=""><a  href="?domande" <?php if(isset($_GET["domande"])) { echo "style='color:#FF7878;'"; }?> >Les demandes</a></li>
                    <li   <?php if(isset($_GET["client"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?>> <img src="images/client.png" width="20" height="20" alt=""><a  href="?client" <?php if(isset($_GET["client"])) { echo "style='color:#FF7878;'"; }?> >Les clients</a></li>
                    <li   <?php if(isset($_GET["static"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?>> <img src="images/statistic.png" width="20" height="20" alt=""><a  href="?static" <?php if(isset($_GET["static"])) { echo "style='color:#FF7878;'"; }?> >Statistiques</a></li>
                    <li   <?php if(isset($_GET["contact"])) { echo "style='background-color: #F7F8FA;border-top-left-radius:10px;border-bottom-left-radius:10px;float:right'"; } else{ echo "style='float:right'" ;}?>> <img src="images/contact.png" width="20" height="20" alt=""><a  href="?contact" <?php if(isset($_GET["contact"])) { echo "style='color:#FF7878;'"; }?> >Contact</a></li>
                </ul>
            </nav>
        </aside>
        <div class="content">
            <?php

                if(!isset($_GET["id_pro"]) && !isset($_GET["id_delP"]) && !isset($_GET["id_delD"]) && !isset($_GET["id_delCl"]) && !isset($_GET["id_delM"])){
                    if(isset($_GET["produit"])){
                        require '../app/component/produits.php';
                    }elseif(isset($_GET["ajouter"])){
                        require '../app/component/ajouter_produit.php';
                    }elseif(isset($_GET["domande"])){
                        require '../app/component/domandes.php';
                    }elseif(isset($_GET["client"])){
                        require '../app/component/client.php';
                    }elseif(isset($_GET["static"])){
                        require '../app/component/static.php';
                    }elseif(isset($_GET["contact"])){
                        require '../app/component/contact.php';
                    }elseif(isset($_GET["profile"])){
                        require '../app/component/profile.php';
                    }elseif(isset($_GET["dashboard"])){
                        require '../app/component/dashboard.php';
                    }else{
                        require '../app/component/dashboard.php';
                    }
                }elseif(isset($_GET["id_pro"])){
                    require '../app/component/update_produit.php';
                }

            ?>
        </div>
     </div>


     <script src="js/admin.js"></script>
</body>
</html>
