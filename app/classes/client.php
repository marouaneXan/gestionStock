<?php


    class User extends DB{
        
       public function getAllusers($pag,$num){
          $sql="SELECT * from user where role like 'client' LIMIT $pag,$num";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute()){
             return $res=$sql->fetchAll();
          }else{
              return 0;
          }

       }

       public function getNumberUsers(){
        $sql="SELECT * from user where role like 'client'";
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

    public function searchusers($email,$nom){

        if(!empty($nom) && empty($email)){
            $sql="SELECT * from user where nom like '$nom' and role like 'client'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute()){
                return $res=$sql->fetchAll();
            }else{
                return 0;
            }
        }elseif(!empty($email) && empty($nom)){
            $sql="SELECT * from user where email like '$email' and role like 'client'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute()){
                return $res=$sql->fetchAll();
            }else{
                return 0;
            }
        }elseif(!empty($nom) && !empty($email)){
            $sql="SELECT * from user where nom like '$nom' and email like '$email' and role like 'client'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute()){
                return $res=$sql->fetchAll();
            }else{
                return 0;
            }
        }

    }


       public function deleteuser($id){

        $sql="DELETE FROM user where id like $id and role like 'client'";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
            return 1;
        }else{
            return 0;
        }

      }

    }


?>