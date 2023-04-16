<?php


class User extends DB{


    public function showOneuSER()
    {

        foreach($this->read() as $user){

            if($user["id_user"] == $_SESSION["id"]){

                return $user;
                
            }
        }

    }
/*
    private function emotyInputs()
    {
        $result;

        // $_POST["uid"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["email"]

        if(empty($_POST["uid"])){

            $counter = -1 ;
            $id =  $_SESSION["id"];

            foreach($this->read() as $user){

                $counter ++;

                if( $user['id_user'] == $id){

                    $_POST["uid"] = $user['userName'];

                }
            }

        }elseif(empty($_POST["pwd"])){

            $counter = -1 ;
            $id =  $_SESSION["id"];

            foreach($this->read() as $user){

                $counter ++;

                if( $user['id_user'] == $id){

                    $_POST["pwd"] = $user['pwd'];

                }
            }

        }
        
        
        
        
        
        else{

            $result = true;

        }

        return $result;
    }
*/

    private function pwdMatch($pwd,$pwdrepeat)
        {
            $result;

            if($pwd !== $pwdrepeat){

                $result = false;

            }else{

                $result = true;
            }

            return $result;
        }

    public function updateUser($uid, $pwd, $pwdrepeat, $email)
    {

        $user = array();
        $id_user = 2;
        $tasks = array(); 

        $counter = -1 ;
        $id =  $_SESSION["id"];

        $decoded_json = $this->read();

        foreach($decoded_json as $oneUser){

            if( $oneUser['id_user'] == $id){

                $id_user = $oneUser['id_user'];

                $tasks = $oneUser['tasks'];

            }

        }

            foreach($this->read() as $user){

                $counter ++;

                if( $user['id_user'] == $id){

                    if(!isset($pwd)){

                        $pwd = $user['pwd'];

                    }elseif(!isset($pwdrepeat)){

                        $pwdrepeat = $user['pwd'];
                    }

                    if($this->pwdMatch($pwd, $pwdrepeat) == false){

                        return header('Location:/web/useredit?error=pwdMatch&uid='.$uid.'&email='.$email.'');
                    }else{

                        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
                    }

                    $decoded_json = $this->read();

                    $user = array(
         
                        'id_user' => $id_user,
                        'userName' => $uid,
                        'email' => $email,
                        'pwd' => $pwd,
                        'tasks' => $tasks,
                        
                        );
                
                    $decoded_json[$counter] = $user;
                    
                    $write = $this->write($decoded_json);

                    return header('Location:/web/home');





                }

        }

    }

    public function deleteUser()
    {

        $counter = -1 ;
        $id =  $_SESSION["id"];

        $userCounter = -1 ;
        $newUserList = array();
        $decoded_json = $this->read();
        $specificUser = $decoded_json[$id];


        foreach($this->read() as $user){

            $counter ++;

            if( $user['id_user'] == $specificUser['id_user']){
                
                //$userCounter++;

            }else{
                        
                //$userCounter++;

                array_push($newUserList,$decoded_json[$counter]);

            }

        }

        $decoded_json = $newUserList;


        $write = $this->write($decoded_json);
        return header('Location:/web');

    }
}
    
?>
 