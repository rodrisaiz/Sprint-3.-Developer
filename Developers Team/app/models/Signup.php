<?php


class Signup extends DB{

    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct($uid2, $pwd2, $pwdrepeat2, $email2){

        $this->uid = $uid2;
        $this->pwd = $pwd2;
        $this->pwdrepeat = $pwdrepeat2;
        $this->email = $email2;
        
    }

    public function signup()
    {
        
        if($this->emotyInputs() == false){

            return header('Location:/web/error?error=emotyInputs');

        }elseif($this->invalidUid() == false){

            return header('Location:/web/error?error=invalidUid');


        }elseif($this->ivalidEmail() == false){

            return header('Location:/web/error?error=ivalidEmail');

        }elseif($this->pwdMatch() == false){

            return header('Location:/web/error?error=pwdMatch');

        }elseif($this->checkUser() == false){

            return header('Location:/web/error?error=checkUser');

        }elseif($this->existingEmail() == false){

            return header('Location:/web/error?error=existingEmail');

        }else{
           
            $this->setUser();

        }
    }

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


    private function checkUser()
    {
        $result  = true;
        $username;
        $email;

        foreach($this->read() as $user){  

            $username = $user["username"]; 

            $email = $user["email"]; 

        
            if($this->uid !== $username || $this->email !== $email){

                $resutl = false;

            }
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
            'pw' => $this->pwd,
            'tareas' => $tareas,
            
            );

        $decoded_json[$finalPosition] = $user;

        $write = $this->write($decoded_json);

        header('Location: /web/');

        
    }


}

?>
 