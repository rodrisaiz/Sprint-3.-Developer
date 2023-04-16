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
	'/taskupdate' => 'task#update',
	'/taskdelete' => 'task#delete',

);

