


<?php

require_once '../app/classes/client.php';
$User=new User();



/*
*
*   make pagination
* 
*/

$rowsUser=$User->getNumberUsers();
$numberPages=5;
$rows=ceil($rowsUser/$numberPages);

if(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="prev"){

   if($_SESSION["pageC"]>0){
     $_SESSION["pageC"]=$_SESSION["pageC"]-1;
     $prevVal=$_SESSION["pageC"];
     $start_position=($prevVal)*$numberPages;
     $dataUser=$User->getAllusers($start_position,$numberPages);
   }else{
     $dataUser=$User->getAllusers(0,$numberPages);
   }
  
}
elseif(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="next"){

  if($_SESSION["pageC"]<$rows){
     $_SESSION["pageC"]=$_SESSION["pageC"]+1;
     $nextVal=$_SESSION["pageC"];
     $start_position=($nextVal-1)*$numberPages;
     $dataUser=$User->getAllusers($start_position,$numberPages);
   }else{
     $nextVal=$_SESSION["pageC"];
     $start_position=($nextVal-1)*$numberPages;
     $dataUser=$User->getAllusers($start_position,$numberPages);
   }
 
}
elseif(!empty($_GET["page"]) && isset($_GET["page"])){
  $_SESSION["pageC"]=$_GET["page"];
  $start_position=($_GET["page"]-1)*$numberPages;
  $dataUser=$User->getAllusers($start_position,$numberPages);
}else{
  $dataUser=$User->getAllusers(0,$numberPages);
}



  /*
  *
  *   search with category and nom 
  * 
  */


  $getInfoUsers=0;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(!empty($_POST['nomClient'])  &&  empty($_POST['emailClient'])){
        $getInfoUsers=$User->searchUsers("",$_POST['nomClient']);
      }elseif(!empty($_POST['emailClient']) && empty($_POST['nomClient'])){
        $getInfoUsers=$User->searchUsers($_POST['emailClient'],"");
      }elseif(!empty($_POST['nomClient']) && !empty($_POST['emailClient'])){
        $getInfoUsers=$User->searchUsers($_POST['emailClient'],$_POST['nomClient']);
      }else{
        $getInfoUsers=$User->getAllusers(0,$numberPages);
      }
  }






?>


  










     <div class="content_dashboard">
         <div class="title">Admin / Clients</div>
 

         <div class="searchProduct">
            <form action="" method="post">
               <input type="text" placeholder="nom" name="nomClient">
               <input type="email" placeholder="email" name="emailClient">
               <input type="submit" value="recherche">
            </form>
         </div>

          <div class="produit_content">
               <table>
                  <tr>
                     <th>Nom</th>
                     <th>Prénom</th>
                     <th>Email</th>
                     <th>Tel</th>
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
                  <?php if($getInfoUsers==0){ foreach($dataUser  as $data){  ?>
                  <tr>
                        <td><?php echo $data["nom"]  ?></td>
                        <td><?php echo $data["prenom"]  ?></td>
                        <td><?php echo $data["email"]  ?></td>
                        <td><?php echo $data["tel"]  ?></td>
                        <td><img src=<?php if(!empty($data["image"])){echo "upload/".$data["image"];}else{echo "images/"."ourLogo.svg";}  ?> alt="" width="40" height="40" srcset=""></td>
                        <td><button  onclick="del(<?php echo $data['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                        <div hidden class="action-produit" id=<?php echo 'action'.$data['id']; ?> >
                           <div class="alertDelete">
                              <h2>Voulez-vous supprimer ce client ?</h2>
                              <br><br>
                              <input type='button' onclick="delClient(<?php echo $data['id'] ?>)" value='supprimer' style='background-color:red;'>
                              <input hidden type="text" class=<?php echo "val-pro".$data["id"];  ?> value= <?php echo $data["id"] ; ?> >
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>
                           
                           <div hidden class="isdeleted">
                              <h2  >Ce produit est supprimé</h2>
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                           <div hidden class="isNotdeleted">
                              <h2  >Réessayez votre opération</h2>
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                        </div>          
                  </tr>
                  <?php }}  elseif($getInfoUsers){ foreach($getInfoUsers  as $dataSearch){  ?>

                     <tr>
                        <td><?php echo $dataSearch["nom"]  ?></td>
                        <td><?php echo $dataSearch["prenom"]  ?></td>
                        <td><?php echo $dataSearch["email"]  ?></td>
                        <td><?php echo $dataSearch["tel"]  ?></td>
                        <td><img src=<?php if(!empty($dataSearch["image"])){echo "upload/".$dataSearch["image"];}else{echo "images/"."ourLogo.svg";}  ?> alt="" width="40" height="40" srcset=""></td>
                        <td><button  onclick="del(<?php echo $dataSearch['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                        <div hidden class="action-produit" id=<?php echo 'action'.$dataSearch['id']; ?> >
                           <div class="alertDelete">
                              <h2>Voulez-vous supprimer ce client ?</h2>
                              <br><br>
                              <input type='button' onclick="delClient(<?php echo $dataSearch['id'] ?>)" value='supprimer' style='background-color:red;'>
                              <input hidden type="text" class=<?php echo "val-pro".$dataSearch["id"];  ?> value= <?php echo $dataSearch["id"] ; ?> >
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>
                           
                           <div hidden class="isdeleted">
                              <h2  >Ce produit est supprimé</h2>
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                           <div hidden class="isNotdeleted">
                              <h2  >Réessayez votre opération</h2>
                              <input class="annuler-client" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                        </div>                            
                     </tr>

                  <?php }} ?>  
     
               </table>

                 <!-- pagination -->

                 <?php if(empty($_POST['emailClient']) && empty($_POST['nomClient'])){ ?>

                     <div class="pagination">
                        <nav>
                              <a href="?client&page=prev"   <?php if(isset($_GET["page"]) && $_GET["page"]=='prev'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Avant</a>
                              <?php for($i=1;$i<=$rows;$i++){ ?>

                                 <a href=<?php  echo "?client&page=".$i; ?>  <?php if(isset($_GET["page"]) && $_GET["page"]==$i){ echo 'style="background-color:#D57E7E;color: white;"'; } else{ echo 'style="background-color:white;color: balck;"';}?> ><?php  echo $i; ?></a>

                           <?php } ?>
                              <a href="?client&page=next"   <?php if(isset($_GET["page"]) && $_GET["page"]=='next'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Après</a>
                        </nav>
                     </div>

                  <?php } ?>


          </div>
     </div>






