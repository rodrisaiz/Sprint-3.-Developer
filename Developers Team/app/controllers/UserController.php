<?php

class UserController extends ApplicationController
{
	public function indexAction()
	{
		return $this->view;
		
	}

	public function registerAction()
	{
		return $this->view;
		
		
	}

	public function signupAction()
	{

		if(isset($_POST["submit"])){

			$signup = new Signup($_POST["uid"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["email"]);

			$signup->signup();
			
		}else{
			echo "error";
		}
			
	}


	public function loginAction()
	{

		if(isset($_POST["submit"])){

			$login = new Login($_POST["email"], $_POST["pwd"]);

			$login->login();
			
			
		}else{
			echo "error";
		}
			
	}


	public function editAction()
	{

		$edit = new User;
		$this->view->_data = $edit->showOneUser();
	}


	public function updateAction()
	{
		if(isset($_POST["submit"])){

			$task = new User();

			$task->updateUser($_POST["uid"], $_POST["pwd"], $_POST["pwdrepeat"], $_POST["email"]);
			
			
		}else{
			echo "error";
		}
	}


}
