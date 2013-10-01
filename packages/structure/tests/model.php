<?php

class Test_Model extends TestCase
{
	public function test_validation_datetime()
	{
		$current_time = time();
		$val = \Validation::forge('test_validation_datetime')
			->add_callable('\\Post\\Model');

		$trust_data = array(
			'datetime' => date('r', $current_time)
		);

		$val->add_field('datetime', 'Datetime', 'valid_datetime');
		$result = $val->run($trust_data);

		$this->assertTrue($result, '$val->run($trust_data)');

		$invalid_data = array(
			'datetime' => 'invalid datetime'
		);

		$val->add_field('datetime', 'Datetime', 'valid_datetime');
		$result = $val->run($invalid_data);

		$this->assertFalse($result, '$val->run($invalid_data)');
	}
}