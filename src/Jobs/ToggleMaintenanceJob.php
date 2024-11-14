<?php

namespace Brickx\MaintenanceSwitch\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class ToggleMaintenanceJob
{
	use Dispatchable;

	public function __construct(public ?string $secret = null, public int|bool $refresh = false) {}

	public function handle() : void
	{
		if (app()->isDownForMaintenance()) {
			Artisan::call('up');
		} else {
			Artisan::call('down', [
				'--secret' => $this->secret,
				'--refresh' => $this->refresh,
			]);
		}
	}
}
