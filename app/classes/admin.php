<?php

 
      
    class Admin extends DB{
        
        public function getAdmin(){
 
           $sql="SELECT * from user where role like 'admin'";
           $sql=$this->connect()->prepare($sql);
           if($sql->execute()){
              return $res=$sql->fetch();
           }else{
               return 0;
           }
 
        }


        public function getAdminLogin($email,$pass){
 
            $sql="SELECT * from user where role like 'admin' and email like '$email' and pass like '$pass' ";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute()){
                if($sql->rowCount()>0){
                    return $res=$sql->fetch();
                }else{
                     return 0;
                }
              
            }else{
                return 0;
            }
  
         }
 
        public function updateAdminInfo($data){
 
        if(!empty($data['image'])){

            $sql="UPDATE user
            SET nom=? ,
                prenom= ?,
                email=? ,
                pass= ?,
                tel= ?,
                image= ?
                where role like 'admin'
           ";
           $sql=$this->connect()->prepare($sql);
           if($sql->execute(array($data['nom'],$data['prenom'],$data['email'],$data['pass'],$data['tel'],$data['image']))){
               return 1;
           }else{
               return 0;
           }

        }else{

            $sql="UPDATE user
            SET nom=? ,
                prenom= ?,
                email=? ,
                pass= ?,
                tel= ?
                where role like 'admin'
           ";
           $sql=$this->connect()->prepare($sql);
           if($sql->execute(array($data['nom'],$data['prenom'],$data['email'],$data['pass'],$data['tel']))){
               return 1;
           }else{
               return 0;
           }

        }
 
    }
 
 
    public function Login($email,$pass){
 
         $sql="SELECT * from user where role like 'admin' and email like $email and pass like $pass";
         $sql=$this->connect()->prepare($sql);
          if($sql->execute()){
             $row=$sql->rowCount();
             if($row>0){
                 $_SESSION["admin_email"]=$email;  
                 return 1;
             }else{
                 return 0;
             }
     
          }else{
              return 0;
          }
    }
 
    public function Logout(){
        session_destroy();
   }
      
 
     }
 




?>