<?php

class TaskController extends ApplicationController
{


	public function homeAction()
	{
		$home = new Task;
		$this->view->_data = $home->showTasks();
	}


	
}
