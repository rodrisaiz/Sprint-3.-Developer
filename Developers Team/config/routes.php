<?php 


$routes = array(
	'/' => 'user#index',
	'/signup' => 'user#signup',
	'/register' => 'user#register',
	'/login' => 'user#login',
	'/home' => 'task#home',
	'/createtask' => 'task#newTask',
	'/taskwrite' => 'task#write',
	'/taskedit' => 'task#edit',
	
	

	'/test3' => 'task#index',
	'/test4' => 'task#check',

);

/*$routes = array(

	'/' => 'login#index',
	'/loginerror' => 'login#error',
	'/login' => 'login#login',
	'/signuphome' => 'signup#index',
	'/signup' => 'signup#signup',
	'/home' => 'home#home',
	'/task' => 'task#taskup',
	'/taskhome' => 'task#index',
	'/taskedithome' => 'task#edithome',
	'/taskedit' => 'task#edit',
	'/user' => 'user#index',
	'/modifyuser' => 'user#userModify',
	'/deleteuser' => 'user#delete',
	'/deleteuser' => 'user#delete',
	

// the following are just test
	'/test' => 'test#index',
	'/testa' => 'test#check',
	'/rodri' => 'rodri#index'


	home -> show all the tasks of that user 

	Title
	Description
	Estatus
	Start date
	End date

);
*/