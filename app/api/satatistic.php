<?php

  require_once '../classes/db.php';
  require_once '../classes/produit.php';

  $produit=new Produit();
  $categories=["Tableau","Chaise","Lit","Porte","Tiroir","Placard"];
  $static=[];

  foreach($categories as $cat){
     array_push($static,$produit->getStatic($cat));
  }

  echo json_encode($static);
  


?>