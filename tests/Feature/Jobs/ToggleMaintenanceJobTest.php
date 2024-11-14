<?php

use Brickx\MaintenanceSwitch\Jobs\ToggleMaintenanceJob;
use Illuminate\Support\Facades\Artisan;

it('puts the app in maintenance mode if up', function () {
	assertUp();

	$job = new ToggleMaintenanceJob;
	$job->handle();

	assertDown();
});

it('removes the maintenance mode if already down', function () {
	Artisan::call('down');

	assertDown();

	$job = new ToggleMaintenanceJob;
	$job->handle();

	assertUp();
});
