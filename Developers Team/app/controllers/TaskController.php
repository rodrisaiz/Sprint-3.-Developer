<?php

class TaskController extends ApplicationController
{


	public function homeAction()
	{
		$home = new Task;
		$this->view->_data = $home->showTask();
	}



	public function indexAction()
	{
		$this->view->message = "hello from task::index";
	}


	
	public function checkAction()
	{
		echo "hello from task::check";
	}
}
