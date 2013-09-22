<?php

class Controller_System extends Controller_Template
{
	public function action_404()
	{
		$this->template = View::forge('404');
	}

	public function action_robots()
	{
		$this->template = "User-agent: *\nAllow: /";

		$response = new Response("User-agent: *\nAllow: /", 200);
		$response->set_header('Content-Type', 'text/plane; charset=utf-8');

		return $response;
	}
}
