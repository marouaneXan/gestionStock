<?php


    class Demand extends DB{
        
       public function getAllDemands($pag,$num){
          $sql="SELECT * from demand LIMIT $pag,$num";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute()){
             return $res=$sql->fetchAll();
          }else{
              return 0;
          }

       }


       public function getNumberDemand(){
        $sql="SELECT * from demand";
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


       public function searchDemands($cat,$dt){

            if(!empty($cat) && empty($dt)){
                $sql="SELECT * from demand where mark like '$cat'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }elseif(!empty($dt) && empty($cat)){
                $sql="SELECT * from demand where created_at like '$dt%'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }elseif(!empty($dt) && !empty($cat)){
                $sql="SELECT * from demand where mark like '$cat' and created_at like '$dt%'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }

       }


       public function deleteDemand($id){

        $sql="DELETE FROM demand where id like $id";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
            return 1;
        }else{
            return 0;
        }

      }

    }


?>