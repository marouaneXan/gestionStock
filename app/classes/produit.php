<?php


    class Produit extends DB{
        
       public function getAllProducts($pag,$num){
          $sql="SELECT * from produit LIMIT $pag,$num";
          $sql=$this->connect()->prepare($sql);
          if($sql->execute()){
             return $res=$sql->fetchAll();
          }else{
              return 0;
          }

       }

       public function getStatic($cat){
            $sql="SELECT * from produit where mark like '$cat'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute()){
                return $row=$sql->rowCount();
            }else{
                return 0;
            }

       }

       public function getProduct($id){
        $sql="SELECT * from produit where id like $id";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
           return $res=$sql->fetch();
        }else{
            return 0;
        }

     }


     public function getProductImage($id){
        $sql="SELECT * from produit where id like $id";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
           return $res=$sql->fetch();
        }else{
            return 0;
        }

     }


       public function getNumberProduit(){
        $sql="SELECT * from produit ";
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


       public function searchProducts($cat,$prix){

            if(!empty($cat) && empty($prix)){
                $sql="SELECT * from produit where mark like '$cat'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }elseif(!empty($prix) && empty($cat)){
                $sql="SELECT * from produit where prix like '$prix'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }elseif(!empty($prix) && !empty($cat)){
                $sql="SELECT * from produit where mark like '$cat' and prix like '$prix'";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute()){
                return $res=$sql->fetchAll();
                }else{
                    return 0;
                }
            }

       }

       public function addProduct($data){

            if(!empty($data['image'])){
                $sql="INSERT INTO `produit` VALUES (NULL, ?, ?, ?, ?, 0, ?);";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute(array($data['nom'],$data['prix'],$data['description'],$data['image'],$data['mark']))){
                    return 1;
                }else{          
                    return 0;
                }
            }else{
                $sql="INSERT INTO `produit` VALUES (NULL, ?, ?, ?, '', 0, ?);";
                $sql=$this->connect()->prepare($sql);
                if($sql->execute(array($data['nom'],$data['prix'],$data['description'],$data['mark']))){
                    return 1;
                }else{          
                    return 0;
                }
            }

       }

       public function updateProduct($data){

           if(!empty($data["image"])){
                $sql="UPDATE produit
                SET nom=? ,
                    prix=? ,
                    description=? ,
                    image=? ,
                    mark=?
                    where id like ?
            ";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute(array($data['nom'],$data['prix'],$data['description'],$data['image'],$data['mark'],$data["id"]))){
                return 1;
            }else{
                return 0;
            }
           }else{
                $sql="UPDATE produit
                SET nom=? ,
                    prix=? ,
                    description=? ,
                    mark=?
                    where id like ?
            ";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute(array($data['nom'],$data['prix'],$data['description'],$data['mark'],$data["id"]))){
                return 1;
            }else{
                return 0;
            }
           }

       }




       public function deleteProduct($id){

        $sql="DELETE FROM produit where id like $id";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute()){
            return 1;
        }else{
            return 0;
        }

      }



    }


?>