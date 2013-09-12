<?php

class Controller_Post extends \Fuel\Core\Controller_Template
{
	public function action_index($type = null)
	{
		$post_class = '\\Post\\Model_'.$type;

		if ( ! class_exists($post_class) )
		{
			throw new HttpNotFoundException('Unknown post type.');
		}

		$data = array(
			'posts' => $post_class::find('all'),
		);

		$this->template->title = Inflector::pluralize(Inflector::humanize($type));
		$this->template->content = View::forge('post/index', $data);
	}
}