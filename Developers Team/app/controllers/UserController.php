<?php

class UserController extends ApplicationController
{
	public function indexAction()
	{
		return $this->view;
		
		//$this->view->message = "hello from User::index";
	}

	
	public function loginAction()
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


}
