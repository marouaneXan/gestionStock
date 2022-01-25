

<?php 

    $action;
    $id;
    
    if(isset($_POST["actionProduit"]) && isset($_POST["idProduit"])){
      $action =$_POST["actionProduit"];
      $id =$_POST["idProduit"];
    }elseif(isset($_POST["actionDemand"]) && isset($_POST["idDemand"])){
        $action =$_POST["actionDemand"];
        $id =$_POST["idDemand"];
    }elseif(isset($_POST["actionClient"]) && isset($_POST["idClient"])){
      $action =$_POST["actionClient"];
      $id =$_POST["idClient"];
    }elseif(isset($_POST["actionContact"]) && isset($_POST["idContact"])){
      $action =$_POST["actionContact"];
      $id =$_POST["idContact"];
    }

    require_once '../classes/db.php'; 
   
?>


<?php

   

  //  function to delete une produit
    function deleteProduit(){
        require '../classes/produit.php'; 
        $produitObject=new Produit();
        $validate=$produitObject->deleteProduct($GLOBALS["id"]);
        if(strcmp($validate,1)==0){
          echo "success";
        }else{
          echo "error";
        }
       
    }

  //  function to delete une demand
  function deleteDemand(){
      require '../classes/demand.php'; 
      $demandObject=new Demand();
      $validate=$demandObject->deleteDemand($GLOBALS["id"]);
      if(strcmp($validate,1)==0){
        echo "success";
      }else{
        echo "error";
      }

  }


  //  function to delete une client
  function deleteClient(){
    require '../classes/client.php'; 
    $clientObject=new User();
    $validate=$clientObject->deleteuser($GLOBALS["id"]);
    if(strcmp($validate,1)==0){
      echo "success";
    }else{
      echo "error";
    }

  }



   //  function to delete une contact
   function deleteContact(){
    require '../classes/contact.php'; 
    $contactObject=new Contact();
    $validate=$contactObject->deletecontact($GLOBALS["id"]);
    if(strcmp($validate,1)==0){
      echo "success";
    }else{
      echo "error";
    }

  }
  





  // switch to use function meaning
   if(strcmp($action,"deleteProduit")==0){
      deleteProduit();
    }elseif(strcmp($action,"deleteDemand")==0){
      deleteDemand();
    }elseif(strcmp($action,"deleteClient")==0){
      deleteClient();
    }elseif(strcmp($action,"deleteContact")==0){
      deleteContact();
    }
    

?>