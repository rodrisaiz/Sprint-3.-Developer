<?php


class Signup extends DB{

    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email)
    {

        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        
    }

    //Sign Up function that calls all the validations and Set User functions 

    public function signup()
    {
        
        if($this->emotyInputs() == false){

            return header('Location:/web/?error=emotyInputs');

        }elseif($this->invalidUid() == false){

            return header('Location:/web/?error=invalidUid');

        }elseif($this->invalidEmail() == false){

            return header('Location:/web/?error=invalidEmail');

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



    private function invalidEmail()
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
            'pwd' => password_hash($this->pwd, PASSWORD_BCRYPT),
            'tareas' => $tareas,
            
            );

        $decoded_json[$finalPosition] = $user;

        $write = $this->write($decoded_json);

        header('Location: /web/');
        
    }

}

?>
 