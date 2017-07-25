<?php

App::uses('AppShell', 'Console/Command');

/**
 * Heroku Shell
 *
 * @category Shell
 * @version  1.0
 * @author   Sitex
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class HerokuShell extends AppShell
{

	public function main()
	{
		$this->out();
		$this->out('Collecting data');

		$db_parsed = parse_url($_ENV['CLEARDB_DATABASE_URL']);
		$admin_user = $_ENV['ADMIN_USER'];
		$admin_password = $_ENV['ADMIN_PASSWORD'];

		$this->out('Dispatching InstallShell');

		$this->dispatchShell(
			'install.install',
			'-d',
			'Mysql',
			'-h',
			$db_parsed['host'],
			'-l',
			$db_parsed['user'],
			'-p',
			$db_parsed['pass'],
			'-n',
			substr($db_parsed['path'], 1),
			'-t',
			'3306',
			'-x',
			'croogo_',
			$admin_user,
			$admin_password
		);

	}

}
