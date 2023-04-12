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

            return header('Location:/web/register?error=emotyInputs&uid='.$this->uid.'&email='.$this->email.'');

        }elseif($this->invalidUid() == false){

            return header('Location:/web/register?error=invalidUid&email='.$this->email.'');

        }elseif($this->invalidEmail() == false){

            return header('Location:/web/register?error=invalidEmail&uid='.$this->uid.'');

        }elseif($this->pwdMatch() == false){

            return header('Location:/web/register?error=pwdMatch&uid='.$this->uid.'&email='.$this->email.'');

        }elseif($this->existingEmail() == false){

            return header('Location:/web/register?error=existingEmail&uid='.$this->uid.'');

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
        $tasks = array();     
       

        $decoded_json = $this->read();


        $finalPosition = count($decoded_json);
        $id_user = $finalPosition + 1;

        $user = array(
         
            'id_user' => $id_user,
            'userName' => $this->uid,
            'email' => $this->email,
            'pwd' => password_hash($this->pwd, PASSWORD_BCRYPT),
            'tasks' => $tasks,
            
            );

        $decoded_json[$finalPosition] = $user;

        $write = $this->write($decoded_json);

        session_start();

        $_SESSION["id"] =  $id_user;

        header('Location: /web/home');
        
    }

}

?>
 