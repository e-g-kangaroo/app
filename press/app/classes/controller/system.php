<?php

class Controller_System extends Controller_Template
{
	public function action_404()
	{
		$this->template = View::forge('404');
	}
}