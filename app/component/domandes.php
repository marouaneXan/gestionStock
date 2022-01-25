


<?php

require_once '../app/classes/demand.php';
$demand=new Demand();



/*
*
*   make pagination
* 
*/

$rowsdemand=$demand->getNumberDemand();
$numberPages=5;
$rows=ceil($rowsdemand/$numberPages);

if(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="prev"){

   if($_SESSION["pageD"]>0){
     $_SESSION["pageD"]=$_SESSION["pageD"]-1;
     $prevVal=$_SESSION["pageD"];
     $start_position=($prevVal)*$numberPages;
     $datademand=$demand->getAllDemands($start_position,$numberPages);
   }else{
     $datademand=$demand->getAllDemands(0,$numberPages);
   }
  
}
elseif(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="next"){

  if($_SESSION["pageD"]<$rows){
     $_SESSION["pageD"]=$_SESSION["pageD"]+1;
     $nextVal=$_SESSION["pageD"];
     $start_position=($nextVal-1)*$numberPages;
     $datademand=$demand->getAllDemands($start_position,$numberPages);
   }else{
     $nextVal=$_SESSION["pageD"];
     $start_position=($nextVal-1)*$numberPages;
     $datademand=$demand->getAllDemands($start_position,$numberPages);
   }
 
}
elseif(!empty($_GET["page"]) && isset($_GET["page"])){
  $_SESSION["pageD"]=$_GET["page"];
  $start_position=($_GET["page"]-1)*$numberPages;
  $datademand=$demand->getAllDemands($start_position,$numberPages);
}else{
  $datademand=$demand->getAllDemands(0,$numberPages);
}



  /*
  *
  *   search with category and nom 
  * 
  */


  $getInfoDemands=0;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(!empty($_POST['dateD'])  &&  empty($_POST['cayegoryD'])){
        $getInfoDemands=$demand->searchDemands("",$_POST['dateD']);
      }elseif(!empty($_POST['cayegoryD']) && empty($_POST['dateD'])){
        $getInfoDemands=$demand->searchDemands($_POST['cayegoryD'],"");
      }elseif(!empty($_POST['dateD']) && !empty($_POST['cayegoryD'])){
        $getInfoDemands=$demand->searchDemands($_POST['cayegoryD'],$_POST['dateD']);
      }else{
        $getInfoDemands=$demand->getAllDemands(0,$numberPages);
      }
  }






?>


  










     <div class="content_dashboard">
         <div class="title">Admin / Demandes</div>
 

         <div class="searchProduct">
            <form action="" method="post">
               <select name="cayegoryD" id="">
                  <option value="" selected disabled>Sélectionner une catégorie</option>
                  <option value="Tableau">Tableau</option>
                  <option value="Chaise">Chaise</option>
                  <option value="Lit">Lit</option>
                  <option value="Porte">Porte</option>
                  <option value="Tiroir">Tiroir</option>
                  <option value="Placard">Placard</option>
               </select>
               <input type="date" name="dateD">
               <input type="submit" value="recherche">
            </form>
         </div>



          <div class="produit_content">
               <table>
                  <tr>
                     <th>Email</th>
                     <th>Marque</th>
                     <th>Total</th>
                     <th>Date</th>
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
                  <?php if($getInfoDemands==0){ foreach($datademand  as $data){  ?>
                     <tr>
                           <td><?php echo $data["email"]  ?></td>
                           <td><?php echo $data["mark"]  ?></td>
                           <td><?php echo $data["total"]  ?></td>
                           <td><?php echo $data["created_at"]  ?></td>
                           <td><img src=<?php if(!empty($data["image"])){echo "upload/".$data["image"];}else{echo "images/"."ourLogo.svg";}  ?> alt="" width="40" height="40" srcset=""></td>
                           <td><button  onclick="del(<?php echo $data['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                           <div hidden class="action-produit" id=<?php echo 'action'.$data['id']; ?> >
                              <div class="alertDelete">
                                 <h2>Voulez-vous supprimer ce demand ?</h2>
                                 <br><br>
                                 <input type='button' onclick="delDemand(<?php echo $data['id'] ?>)" value='supprimer' style='background-color:red;'>
                                 <input hidden type="text" class=<?php echo "val-pro".$data["id"];  ?> value= <?php echo $data["id"] ; ?> >
                                 <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                              </div>
                              
                              <div hidden class="isdeleted">
                                 <h2>Ce produit est supprimé</h2>
                                 <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                              </div>

                              <div hidden class="isNotdeleted">
                                 <h2>Réessayez votre opération</h2>
                                 <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                              </div>

                           </div>              
                     </tr>
                  <?php }}  elseif($getInfoDemands){ foreach($getInfoDemands  as $dataSearch){  ?>
                     <tr>
                        <td><?php echo $dataSearch["email"]  ?></td>
                        <td><?php echo $dataSearch["mark"]  ?></td>
                        <td><?php echo $dataSearch["total"]  ?></td>
                        <td><?php echo $dataSearch["created_at"]  ?></td>
                        <td><img src=<?php if(!empty($dataSearch["image"])){echo "upload/".$dataSearch["image"];}else{echo "images/"."ourLogo.svg";}  ?> alt="" width="40" height="40" srcset=""></td>
                        <td><button  onclick="del(<?php echo $dataSearch['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                        <div hidden class="action-produit" id=<?php echo 'action'.$dataSearch['id']; ?> >
                           <div class="alertDelete">
                              <h2>Voulez-vous supprimer ce demand ?</h2>
                              <br><br>
                              <input type='button' onclick="delDemand(<?php echo $dataSearch['id'] ?>)" value='supprimer' style='background-color:red;'>
                              <input hidden type="text" class=<?php echo "val-pro".$dataSearch["id"];  ?> value= <?php echo $dataSearch["id"] ; ?> >
                              <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>
                           
                           <div hidden class="isdeleted">
                              <h2  >Ce produit est supprimé</h2>
                              <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                           <div hidden class="isNotdeleted">
                              <h2  >Réessayez votre opération</h2>
                              <input class="annuler-demand" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                        </div>            
                    </tr>
                  <?php }} ?>
              
               </table>

             
               <!-- pagination -->

               <?php if(empty($_POST['cayegoryD']) && empty($_POST['dateD'])){ ?>

                     <div class="pagination">
                        <nav>
                              <a href="?domande&page=prev"   <?php if(isset($_GET["page"]) && $_GET["page"]=='prev'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Avant</a>
                              <?php for($i=1;$i<=$rows;$i++){ ?>

                                 <a href=<?php  echo "?domande&page=".$i; ?>  <?php if(isset($_GET["page"]) && $_GET["page"]==$i){ echo 'style="background-color:#D57E7E;color: white;"'; } else{ echo 'style="background-color:white;color: balck;"';}?> ><?php  echo $i; ?></a>

                           <?php } ?>
                              <a href="?domande&page=next"   <?php if(isset($_GET["page"]) && $_GET["page"]=='next'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Après</a>
                        </nav>
                     </div>

               <?php } ?>

          </div>
     </div>






