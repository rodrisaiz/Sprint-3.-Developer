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
            return header('Location:/web/?error=autentication');

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
    




/*
    //Sign Up function that calls all the validations and Set User functions 






    public function signup()
    {
        
        if($this->emotyInputs() == false){

            return header('Location:/web/?error=emotyInputs');

        }elseif($this->invalidUid() == false){

            return header('Location:/web/?error=invalidUid');

        }elseif($this->ivalidEmail() == false){

            return header('Location:/web/?error=ivalidEmail');

        }elseif($this->pwdMatch() == false){

            return header('Location:/web/?error=pwdMatch');

        }elseif($this->existingEmail() == false){

            return header('Location:/web/?error=existingEmail');

        }else{
           
            $this->setUser();

        }

    }

    //Validations functions 

    private function emotyInputs()
    {
        $result;

        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)){
            $result = false;

        } else{

            $result = true;

        }

        return $result;
    }



    private function invalidUid()
    {
        $result;
        
        if(!preg_match(" /^[a-zA-Z-'\s]*$/ ", $this->uid)){

            $result = false;

        }else{

            $result = true;
        }

        return $result;
    }



    private function ivalidEmail()
    {
        $result;

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){

            $result = false;

        }else{

            $result = true;
        }

        return $result;
    }



    private function pwdMatch()
    {
        $result;

        if($this->pwd !== $this->pwdrepeat){

            $result = false;

        }else{

            $result = true;
        }

        return $result;
    }




    private function existingEmail()
    {

        $result = true;
        $user;

        foreach($this->read() as $user){

            if($user["email"] == $this->email){

                $result = false;
            }
        }
        
        return $result;
    }


    //Set-user it´is the function in charge to save a new user in the DB

    public function setUser(){


        $user = array();
        $id_user = "";
        $tareas = array();     
       

        $decoded_json = $this->read();


        $finalPosition = count($decoded_json);
        $id_user = $finalPosition + 1;

        $user = array(
         
            'id_user' => $id_user,
            'userName' => $this->uid,
            'email' => $this->email,
            'pw' => password_hash($this->pwd, PASSWORD_BCRYPT),
            'tareas' => $tareas,
            
            );

        $decoded_json[$finalPosition] = $user;

        $write = $this->write($decoded_json);

        header('Location: /web/');
        
    }
*/
}

?>
 