<?php

class Task extends DB{



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

            return header('Location:/web/createtask?error=emotyInputs&title='.$title.'&description='.$description.'&status='.$status.'');

        }else{

            $counter = -1;

            $id = $_SESSION["id"];

            foreach($this->read() as $user){
                $counter ++;

                if( $user['id_user'] == $id){

                    $decoded_json = $this->read();
            
                    $finalTask = count($decoded_json[$counter]['tasks']);

                    $tasks = $decoded_json[$counter]['tasks'];

                    $id_task = 0;

                    foreach($tasks as $oneTask){

                        $id_task = $oneTask['id_task'] + 1;

                    }


                    $task = array(

                        'id_task' => $id_task,
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


    public function showOneTask($taskPosition)
    {

        $user;

        foreach($this->read() as $user){

            if($user["id_user"] == $_SESSION["id"]){

                return $user["tasks"][$taskPosition];
                
            }
        }

    }


    public function updateTask($title, $description, $status, $start_date, $end_date)
    {

        if($this->emotyInputs() == false){

            return header('Location:/web/taskedit?error=emotyInputs&title='.$title.'&description='.$description.'&status='.$status.'');

        }else{

            $counter = -1 ;
            $id =  $_SESSION["id"];

            foreach($this->read() as $user){

                $counter ++;

                if( $user['id_user'] == $id){

                    $decoded_json = $this->read();

                    $taskPosition = $_GET['item'];

                    $id_task = $decoded_json[$counter]['tasks'][$taskPosition]['id_task'];

                    $task = array(

                        'id_task' => $id_task,
                        'title' => $title,
                        'description' => $description,
                        'status' => $status,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    );

                
                    $decoded_json[$counter]['tasks'][$taskPosition] = $task;

                    $write = $this->write($decoded_json);

                    return header('Location:/web/home');
                }
            }
        }
    }


    public function deleteTask()
    {

        $counter = -1 ;
        $id =  $_SESSION["id"];

        foreach($this->read() as $user){

            $counter ++;

            if( $user['id_user'] == $id){

                $taskPosition = $_GET['item'];
                $decoded_json = $this->read();


                $tasks = $decoded_json[$counter]['tasks'];
                $tasksCounter = -1 ;
                $specificTask = $decoded_json[$counter]['tasks'][$taskPosition];
                $newTasksList = array();

                foreach ($tasks  as $task){

                    if($task['id_task'] == $specificTask['id_task'] ){

                        $tasksCounter++;

                    }else{
                        
                        $tasksCounter++;
                        array_push($newTasksList,$decoded_json[$counter]['tasks'][$tasksCounter]);

                    }

                }

                $decoded_json[$counter]['tasks'] = $newTasksList;


                $write = $this->write($decoded_json);
                return header('Location:/web/home');

            }
        }
    }
}


?>
