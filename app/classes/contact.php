<?php


    class Contact extends DB{
        
       public function getAllcontacts($pag,$num){
          $sql="SELECT * from contact LIMIT $pag,$num";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute()){
             return $res=$sql->fetchAll();
          }else{
              return 0;
          }

       }

       public function getNumberContacts(){
        $sql="SELECT * from contact";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
            if($sql->rowCount()>0){
                return $sql->rowCount();
            }else{
                 return 0;
            }
        }else{
            return 0;
        }

     }

       public function searchcontacts($email){

            if(!empty($email)){
                $sql="SELECT * from contact where email like '$email' ";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                    return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }

       }


       public function deletecontact($id){

        $sql="DELETE FROM contact where id like $id ";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
            return 1;
        }else{
            return 0;
        }

      }

    }


?>