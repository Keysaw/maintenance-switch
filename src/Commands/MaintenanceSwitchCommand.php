<?php

namespace Brickx\MaintenanceSwitch\Commands;

use Illuminate\Console\Command;

class MaintenanceSwitchCommand extends Command
{
	public $signature = 'maintenance-switch';

	public $description = 'My command';

	public function handle() : int
	{
		$this->comment('All done');

		return self::SUCCESS;
	}
}
