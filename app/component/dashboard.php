<?php

    require_once '../app/classes/client.php';
    require_once '../app/classes/demand.php';
    require_once '../app/classes/produit.php';

    $client=new User();
    $rowsClient=$client->getNumberUsers();

    $demand=new Demand();
    $rowsDemand=$demand->getNumberDemand();

    $produit=new Produit();
    $rowsProduit=$produit->getNumberProduit();


?>



     <div class="content_dashboard">
         <div class="title">Admin / Dashboard</div>
          <div class="statics">
             <div class="content_st">
                <div><span><?php echo $rowsProduit; ?></span><img src="images/produit.png" alt="" srcset=""></div>
                <div class="title_item">les produits</div>
             </div>
             <div class="content_st">
                <div><span><?php echo $rowsClient; ?></span><img src="images/client.png"  alt="" srcset=""></div>
                <div class="title_item">les clients</div>
             </div>
             <div class="content_st">
                <div><span><?php echo $rowsDemand; ?></span><img src="images/demande.png" alt="" srcset=""></div>
                <div class="title_item">les demandes</div>
             </div>
          </div>
         
     </div>






