<?php

class Task extends DB{


    public function showTask()
    {

        $user;

        foreach($this->read() as $user){

            if($user["id_user"] == $_SESSION["id"]){

                return $user["tasks"];
                
            }
        }

    }


  /*
    public $user;
    public $tarea;
    public $userPosition;
    public $data;

    public function session()
    {

        $this->userPosition =  $_SESSION["userPosition"];

    }

    public function homeAction()
    {

        $this->session();

        $this->user = $this->read()[$this->userPosition];


        return $this->user["tareas"];

    }
*/


}
?>
