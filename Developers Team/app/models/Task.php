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

    private function emotyInputs()
    {
        $result;

        if(empty($_POST["title"]) || empty($_POST["description"]) || empty($_POST["status"])){

            $result = false;

        } else{

            $result = true;

        }

        return $result;
    }


    public function writeTask($title, $description, $status, $start_date, $end_date)
    {

        if($this->emotyInputs() == false){

            //$hola = $title;

            return header('Location:/web/createtask?error=emotyInputs&title='.$title.'&description='.$description.'&status='.$status.'');

        }else{

            $counter = -1;
            $id =  $_SESSION["id"];

            foreach($this->read() as $user){

                if( $user['id_user'] == $id){

                    $counter ++;

                    $decoded_json = $this->read();
            
                    $finalTask = count($decoded_json[$counter]['tasks']);

                    $task = array(

                        'title' => $title,
                        'description' => $description,
                        'status' => $status,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    );

                
                    $decoded_json[$counter]['tasks'][$finalTask] = $task;

                    $write = $this->write($decoded_json);

                    return header('Location:/web/home');
                }
            }
        }
    }



}
?>
