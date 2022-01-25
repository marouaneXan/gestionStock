<?php

  require_once '../classes/db.php';


  $data=[];
  $error="";
  $errortel="Téléphone est vide";
  $errorName="Nom est vide";
  $errorPrename="Prénom est vide";
  $erroremail="Email est vide";
  $errorOldpassword="Votre mot de pass est incorrect";
  $errorNewpassword="Votre confirmation de mot de pass est incorrecte";
  $errorPrix="Prix est vide";
  $errorTypePrix="veuillez entrer des chiffres";
  $errorDescription="Description est vide";
  $errorCategory="Categorie est vide";
  $errorImage="Aucune image séléctionnée";


  // ------------------  function to update product ---------------------
   function updateProduct(){
       if(empty($_POST["nom"])){
           $GLOBALS["error"]=$GLOBALS["errorName"];
       }
       if(empty($_POST["prix"])){
           $GLOBALS["error"].="<br>";
           $GLOBALS["error"].=$GLOBALS["errorPrix"];
       }
       if(empty($_POST["category"])){
           $GLOBALS["error"].="<br>";
           $GLOBALS["error"].=$GLOBALS["errorCategory"];
       }
       if(empty($_POST["description"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["errorDescription"];
       }
       if(empty($GLOBALS["error"])){

           require_once '../classes/produit.php';
           $produit=new Produit();

            $GLOBALS["data"]["nom"]=$_POST["nom"];
            $GLOBALS["data"]["prix"]=$_POST["prix"];
            $GLOBALS["data"]["mark"]=$_POST["category"];
            $GLOBALS["data"]["description"]=$_POST["description"];
            $GLOBALS["data"]["id"]=$_POST["id_pro"];

           if(!empty($_FILES["image"]["tmp_name"])){

                $file=$_FILES["image"]["tmp_name"];
                $name=$_FILES["image"]["name"];
                $extention=explode(".",$name);
                $newNmae=uniqid()."chopNow".".".$extention[1];
                $fileUpload="../../admin/upload/".$newNmae;
                
                if(move_uploaded_file($file,$fileUpload)){
                    $GLOBALS["data"]["image"]=$newNmae;
                    $oldImage=$produit->getProductImage($_POST["id_pro"]);
                   if($produit->updateProduct($GLOBALS["data"])){
                    echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;"> Votre informations bien enregistrée</div>';
                       if(!empty($oldImage["image"])){unlink('../../admin/upload/'.$oldImage["image"]);}
                   }else{
                       echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre modification</div>';
                   }
                    
                }else{
                    echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Aucune image téléchrgée</div>';
                 
                }

            }else{
                $GLOBALS["data"]["image"]="";
                if($produit->updateProduct($GLOBALS["data"])){
                    echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;"> Votre informations bien enregistrée</div>';

                }else{
                    echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre modification</div>';
                }
           
            }
       }else{
        echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">'.$GLOBALS["error"].'</div>';
      
       }

   }


















 // ------------------  function to update profile admin ---------------------
 function updateProfile(){

    require_once '../classes/admin.php';
    $admin=new Admin();


    if(empty($_POST["nom"])){
        $GLOBALS["error"]=$GLOBALS["errorName"];
    }
    if(empty($_POST["prenom"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["errorPrename"];
    }
    if(empty($_POST["email"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["erroremail"];
    }




    if(!empty($_POST["oldpassword"])){

        $adminInfo=$admin->getAdmin();
        // $pwd=hash_hmac('sha256',$_POST["oldpassword"], 'secret', true);
        if(strcmp($adminInfo["pass"],$_POST["oldpassword"])!=0){
            $GLOBALS["error"].="<br>";
            $GLOBALS["error"].=$GLOBALS["errorOldpassword"];
            // $GLOBALS["error"].=$adminInfo["pass"];
            // $GLOBALS["error"].="<br>";
            // $GLOBALS["error"].=$pwd;
        } 
        
    }
    if(!empty($_POST["newpassword"]) && empty($_POST["oldpassword"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].="entrer votre old password";
    }
    if(empty($_POST["newpassword"]) && !empty($_POST["oldpassword"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].="entrer votre neceaux mote de pass";
    }
    if(!empty($_POST["oldpassword"]) && !empty($_POST["newpassword"])){
        $GLOBALS["data"]["pass"]=$_POST["newpassword"];
    }else{
            $adminPass=$admin->getAdmin();
            $GLOBALS["data"]["pass"]=$adminPass["pass"];
    }



    
    if(empty($_POST["tel"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["errortel"];
    }
    if(empty($GLOBALS["error"])){

    

        $GLOBALS["data"]["nom"]=$_POST["nom"];
        $GLOBALS["data"]["prenom"]=$_POST["prenom"];
        $GLOBALS["data"]["email"]=$_POST["email"];
       
        $GLOBALS["data"]["oldpassword"]=$_POST["oldpassword"];
        $GLOBALS["data"]["newpassword"]=$_POST["newpassword"];
        $GLOBALS["data"]["tel"]=$_POST["tel"];
            

        if(!empty($_FILES["image"]["tmp_name"])){

             $file=$_FILES["image"]["tmp_name"];
             $name=$_FILES["image"]["name"];
             $extention=explode(".",$name);
             $newNmae=uniqid()."admin".".".$extention[1];
             $fileUpload="../../admin/upload/".$newNmae; 
             
             if(move_uploaded_file($file,$fileUpload)){
                 $GLOBALS["data"]["image"]=$newNmae;
                 $oldImage=$admin->getAdmin();
                if($admin->updateAdminInfo($GLOBALS["data"])){
                 echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;">Votre informations bien enregistrée</div>';
                    if(!empty($oldImage["image"])){unlink('../../admin/upload/'.$oldImage["image"]);}
                }else{
                    echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre modification</div>';
                }
                 
             }else{
                 echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Aucune image téléchrgée</div>';
              
             }

         }else{
             $GLOBALS["data"]["image"]="";
             if($admin->updateAdminInfo($GLOBALS["data"])){
                 echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;">Votre informations bien enregistrée</div>';

             }else{
                 echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre modification</div>';
             }
        
         }
    }else{
     echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">'.$GLOBALS["error"].'</div>';
   
    }

}










  // ------------------  function to ajouter product ---------------------
  function ajouterProduct(){
    if(empty($_POST["nom"])){
        $GLOBALS["error"]=$GLOBALS["errorName"];
    }
    if(empty($_POST["prix"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["errorPrix"];
    }
    if(empty($_POST["category"])){
        $GLOBALS["error"].="<br>";
        $GLOBALS["error"].=$GLOBALS["errorCategory"];
    }
    if(empty($_POST["description"])){
     $GLOBALS["error"].="<br>";
     $GLOBALS["error"].=$GLOBALS["errorDescription"];
    }
    if(empty($GLOBALS["error"])){

        require_once '../classes/produit.php';
        $produit=new Produit();

         $GLOBALS["data"]["nom"]=$_POST["nom"];
         $GLOBALS["data"]["prix"]=$_POST["prix"];
         $GLOBALS["data"]["mark"]=$_POST["category"];
         $GLOBALS["data"]["description"]=$_POST["description"];
         
        if(!empty($_FILES["image"]["tmp_name"])){
             
             $file=$_FILES["image"]["tmp_name"];
             $name=$_FILES["image"]["name"];
             $extention=explode(".",$name);
             $newNmae=uniqid()."chopNow".".".$extention[1];
             $fileUpload="../../admin/upload/".$newNmae;
             
             if(move_uploaded_file($file,$fileUpload)){
                $GLOBALS["data"]["image"]=$newNmae;
                if($produit->addProduct($GLOBALS["data"])){
                 echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;">Votre informations bien enregistrée</div>';
                }else{
                    echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre ajouter</div>';
                }
             }else{
                 echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Aucune image téléchrgée</div>';
              
             }

         }else{
             $GLOBALS["data"]["image"]="";
             if($produit->addProduct($GLOBALS["data"])){
                 echo '<div  style="color:white;text-align:center;background-color:#5CDB6F;padding:10px;">Votre informations bien enregistrée</div>';

             }else{
                 echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">Veuillez réessayer votre ajouter</div>';
             }
        
         }
    }else{
     echo '<div  style="color:white;text-align:center;background-color:#F55347;padding:10px;">'.$GLOBALS["error"].'</div>';
     
    }

}




  if(isset($_POST["action"])=="updateProduct"){
    updateProduct();
  }elseif(isset($_POST["actiona"])=="updateProfile"){
    updateProfile();
  }elseif(isset($_POST["actionAjouter"])=="ajouterProduct"){
    ajouterProduct();
  }
 



  
?>