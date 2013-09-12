<?php

class Controller_System extends \Fuel\Core\Controller_Template
{
	public function action_dashboard()
	{
		$this->template->title = 'Dashboard';
		$this->template->content = View::forge('system/dashboard');
	}

	public function action_404()
	{
		$this->template->title = '404 Not Found';
		$this->template->content = View::forge('system/404');
	}
}
