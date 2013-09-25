<?php

class Test_Model extends TestCase
{
	public function test_validation_datetime()
	{
		$current_time = time();
		$val = \Validation::forge('test_validation_datetime')
			->add_callable('\\Post\\Model');

		$data = array(
			'datetime' => date('r', $current_time)
		);

		$val->add_field('datetime', 'Datetime', 'datetime');
		$result = $val->run($data);

		$this->assertTrue($result, '$val->run($data)');
	}
}