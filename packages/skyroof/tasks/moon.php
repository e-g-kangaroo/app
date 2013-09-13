<?php

namespace Fuel\Tasks;

class Moon
{
	public function create($target = null)
	{
		if ( method_exists($this, 'create_'.$target) )
		{
			call_user_func(array($this, 'create_'.$target));
		}
	}

	public function create_options()
	{
    // load skyroof config
    \Config::load('skyroof', true);

    if (\Config::get('skyroof.options.driver') != 'db')
    {
        $continue = \Cli::prompt(\Cli::color('Your current driver type is not set db. Would you like to continue and add the options table anyway?', 'yellow'), array('y','n'));

        if ($continue === 'n')
        {
            return \Cli::color('Database options table was not created.', 'red');
        }
    }

    if (\DBUtil::table_exists(\Config::get('skyroof.options.db.table')))
    {
        return \Cli::write('Options table already exists.');
    }

    // create the option table using the table name from the config file
    \DBUtil::create_table(\Config::get('skyroof.options.db.table'), array(
    	'name'  => array('constraint' => 120, 'type' => 'varchar'),
    	'value' => array('type' => 'text'),
    ), array('name'), false, 'InnoDB', \Config::get('db.default.charset'));

    if (\Config::get('skyroof.options.driver') === 'db')
    {
        return \Cli::color('Success! Your options table has been created!', 'green');
    }
    else
    {
        return \Cli::color('Success! Your options table has been created! Your current option driver type is set to '.\Config::get('skyroof.options.driver').'. In order to use the table you just created to manage your options, you will need to set your driver type to "db" in your option config file.', 'green');
    }
	}

}