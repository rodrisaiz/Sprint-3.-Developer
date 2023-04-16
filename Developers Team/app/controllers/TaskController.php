<?php

class TaskController extends ApplicationController
{


	public function homeAction()
	{
		$home = new Task;
		$this->view->_data = $home->showTasks();
	}


	public function newTaskAction()
	{
		return $this->view;
	}

	public function writeAction()
	{
		if(isset($_POST["submit"])){

			$task = new Task();

			$task->writeTask($_POST["title"], $_POST["description"], $_POST["status"], $_POST["start_date"], $_POST["end_date"]);
			
			
		}else{
			echo "error";
		}
	}

	public function editAction()
	{

		$edit = new Task;
		$this->view->_data = $edit->showOneTask($_GET["item"]);
	}


	public function updateAction()
	{
		if(isset($_POST["submit"])){

			$task = new Task();

			$task->updateTask($_POST["title"], $_POST["description"], $_POST["status"], $_POST["start_date"], $_POST["end_date"]);
			
			
		}else{
			echo "error";
		}
	}


	public function deleteAction()
	{
	
			$task = new Task();

			$task->deleteTask();
			
	}

}
