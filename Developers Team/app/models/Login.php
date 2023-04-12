<?php


class Login extends DB{

    private $email;
    private $pwd;
   

    public function __construct($email, $pwd)
    {

        $this->email = $email;
        $this->pwd = $pwd;
        
        
    }

    
    public function login(){


        if($this->notExistingEmail() == false){

            session_destroy();
            return header('Location:/web/?error=notExistingEmail');

        }elseif($this->autentication() == false){

            session_destroy();
            return header('Location:/web/?error=autentication&email='.$this->email.'');

        }else{
           
            return header('Location:/web/home');
            
        }


    }


    private function notExistingEmail()
    {

        $result = false;
        $user;

        foreach($this->read() as $user){


            if($user["email"] == $this->email){

                session_start();

                $_SESSION["id"] = $user["id_user"];

                $result = true;

            }
            
        }
        
        return $result;
    }


    private function autentication()
    {

        $result = false;

        foreach($this->read() as $user){

            if($user["id_user"] == $_SESSION["id"]){

                if(password_verify($this->pwd , $user["pwd"])){
                  
                    $result = true;

                }
            }
        }

        return $result;
        
    }
}

?>
 