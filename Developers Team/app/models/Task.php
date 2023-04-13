<?php

class Task extends DB{

    public $id;


    public function showTasks()
    {

        $user;

        foreach($this->read() as $user){

            if($user["id_user"] == $_SESSION["id"]){

                return $user["tasks"];
                
            }
        }

    }

    

}
?>
