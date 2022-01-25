


<?php

   require_once '../app/classes/contact.php';
   $Contact=new Contact();



   /*
   *
   *   make pagination
   * 
   */

   $rowsContact=$Contact->getNumberContacts();
   $numberPages=5;
   $rows=ceil($rowsContact/$numberPages);

   if(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="prev"){

      if($_SESSION["pageCon"]>0){
      $_SESSION["pageCon"]=$_SESSION["pageCon"]-1;
      $prevVal=$_SESSION["pageCon"];
      $start_position=($prevVal)*$numberPages;
      $dataContact=$Contact->getAllcontacts($start_position,$numberPages);
      }else{
      $dataContact=$Contact->getAllcontacts(0,$numberPages);
      }
   
   }
   elseif(isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]=="next"){

   if($_SESSION["pageCon"]<$rows){
      $_SESSION["pageCon"]=$_SESSION["pageCon"]+1;
      $nextVal=$_SESSION["pageCon"];
      $start_position=($nextVal-1)*$numberPages;
      $dataContact=$Contact->getAllcontacts($start_position,$numberPages);
      }else{
      $nextVal=$_SESSION["pageCon"];
      $start_position=($nextVal-1)*$numberPages;
      $dataContact=$Contact->getAllcontacts($start_position,$numberPages);
      }
   
   }
   elseif(!empty($_GET["page"]) && isset($_GET["page"])){
   $_SESSION["pageCon"]=$_GET["page"];
   $start_position=($_GET["page"]-1)*$numberPages;
   $dataContact=$Contact->getAllcontacts($start_position,$numberPages);
   }else{
   $dataContact=$Contact->getAllcontacts(0,$numberPages);
   }



  /*
  *
  *   search with category and nom 
  * 
  */


  $getInfoContacts=0;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(!empty($_POST['emailContact'])){
        $getInfoContacts=$Contact->searchcontacts($_POST['emailContact']);
      }else{
        $getInfoContacts=$Contact->getAllcontacts(0,$numberPages);
      }
  }






?>


  












     <div class="content_dashboard">
         <div class="title">Admin / Contact</div>

         <div class="searchProduct">
            <form action="" method="post">
               <input type="email" placeholder="email" name="emailContact">
               <input type="submit" value="recherche">
            </form>
         </div>
 
          <div class="produit_content">
               <table>
                  <tr>
                     <th>Email</th>
                     <th>Message</th>
                     <th>Date</th>
                     <th>Action</th>
                  </tr>
                  <?php if($getInfoContacts==0){ foreach($dataContact  as $data){  ?>
                  <tr>
                     <td><?php echo $data["email"]  ?></td>
                     <td class="message"><?php echo $data["message"]  ?>e </td>
                     <td><?php echo $data["date"]  ?></td>
                     <td><button  onclick="del(<?php echo $data['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                        <div hidden class="action-produit" id=<?php echo 'action'.$data['id']; ?> >
                           <div class="alertDelete">
                              <h2>Voulez-vous supprimer ce contact ?</h2>
                              <br><br>
                              <input type='button' onclick="delContact(<?php echo $data['id'] ?>)" value='supprimer' style='background-color:red;'>
                              <input hidden type="text" class=<?php echo "val-pro".$data["id"];  ?> value= <?php echo $data["id"] ; ?> >
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>
                           
                           <div hidden class="isdeleted">
                              <h2  >Ce produit est supprimé</h2>
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                           <div hidden class="isNotdeleted">
                              <h2  >Réessayez votre opération</h2>
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                        </div>          
                  </tr>
                  <?php }}  elseif($getInfoContacts){ foreach($getInfoContacts  as $dataSearch){  ?>
                     <tr>
                     <td><?php echo $dataSearch["email"]  ?></td>
                     <td class="message"><?php echo $dataSearch["message"]  ?>e </td>
                     <td><?php echo $dataSearch["date"]  ?></td>
                     <td><button  onclick="del(<?php echo $dataSearch['id'] ?>)" class="supprimer" style="cursor:pointer;"><img src="images/delete.png" width="30" height="30" alt="" srcset=""></button></td>
                        
                        <div hidden class="action-produit" id=<?php echo 'action'.$dataSearch['id']; ?> >
                           <div class="alertDelete">
                              <h2>Voulez-vous supprimer ce contact ?</h2>
                              <br><br>
                              <input type='button' onclick="delContact(<?php echo $dataSearch['id'] ?>)" value='supprimer' style='background-color:red;'>
                              <input hidden type="text" class=<?php echo "val-pro".$dataSearch["id"];  ?> value= <?php echo $dataSearch["id"] ; ?> >
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>
                           
                           <div hidden class="isdeleted">
                              <h2  >Ce produit est supprimé</h2>
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                           <div hidden class="isNotdeleted">
                              <h2  >Réessayez votre opération</h2>
                              <input class="annuler-contact" type='button' value='annuler' style='background-color:#8833FF;'>
                           </div>

                        </div>                            </tr>
                  <?php }} ?>  
                
                 
               </table>

                <!-- pagination -->

                <?php if(empty($_POST['emailContact'])){ ?>

                     <div class="pagination">
                        <nav>
                              <a href="?contact&page=prev"   <?php if(isset($_GET["page"]) && $_GET["page"]=='prev'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Avant</a>
                              <?php for($i=1;$i<=$rows;$i++){ ?>

                                 <a href=<?php  echo "?contact&page=".$i; ?>  <?php if(isset($_GET["page"]) && $_GET["page"]==$i){ echo 'style="background-color:#D57E7E;color: white;"'; } else{ echo 'style="background-color:white;color: balck;"';}?> ><?php  echo $i; ?></a>

                           <?php } ?>
                              <a href="?contact&page=next"   <?php if(isset($_GET["page"]) && $_GET["page"]=='next'){ echo 'style="background-color:#D57E7E;color: white;"'; } ?>>Après</a>
                        </nav>
                     </div>

                  <?php } ?>

                <br><br><br><br>

          </div>
     </div>





