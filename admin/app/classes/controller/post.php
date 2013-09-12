<?php

class Controller_Post extends \Fuel\Core\Controller_Template
{
	public function before()
	{
		parent::before();
		Package::load('airplane');
	}

	public function action_index($type = null)
	{
		$post_class = '\\Post\\Model_'.$type;

		if ( ! class_exists($post_class) )
		{
			throw new HttpNotFoundException('Unknown post type.');
		}

		$data = array(
			'type' => $type,
			'posts' => $post_class::find('all'),
		);

		$this->template->title = Inflector::pluralize(Inflector::humanize($type));
		$this->template->content = View::forge('post/index', $data);
	}

	public function action_edit($id = null)
	{
		$type = $this->param('type');
		$post_class = '\\Post\\Model_'.$type;

		if ( ! class_exists($post_class) )
		{
			throw new HttpNotFoundException('Unknown post type.');
		}

		$data = array(
			'type' => $type,
			'post' => $post_class::find($id),
		);

		if ( empty($data['post']) )
		{
			Response::redirect('post/'.$type);
		}

		if ( Input::method() == 'POST' and Security::check_token() )
		{
			Log::info('ok');

			foreach ( $post_class::form_map() as $name => $property )
			{
				$data['post']->$name = Input::post($name);
			}

			$data['post']->save();
		}

		$this->template->title = $data['post']->title();
		$this->template->content = View::forge('post/edit', $data);
	}
}