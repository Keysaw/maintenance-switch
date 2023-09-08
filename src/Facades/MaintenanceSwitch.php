<?php

namespace Brickx\MaintenanceSwitch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Brickx\MaintenanceSwitch\MaintenanceSwitch
 */
class MaintenanceSwitch extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \Brickx\MaintenanceSwitch\MaintenanceSwitch::class;
	}
}
