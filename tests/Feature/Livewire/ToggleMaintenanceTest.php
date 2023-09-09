<?php

use Brickx\MaintenanceSwitch\Livewire\ToggleMaintenance;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertNull;

it('is only visible for authenticated users', function () {
	expect(livewire(ToggleMaintenance::class)->get('visible'))
		->toBeFalse();

	actingAs(new User);
	assertAuthenticated();

	expect(livewire(ToggleMaintenance::class)->get('visible'))
		->toBeTrue();
});

it('can be visible only for users with the right permissions', function () {
	Config::set('maintenance-switch.permissions', 'toggle-maintenance');
	actingAs($user = new User);

	expect($user->can('toggle-maintenance'))
		->toBeFalse()
		->and(livewire(ToggleMaintenance::class)->get('visible'))
		->toBeFalse();

	$user->id = 1;

	expect($user->can('toggle-maintenance'))
		->toBeTrue()
		->and(livewire(ToggleMaintenance::class)->get('visible'))
		->toBeTrue();
});

it('can generate a secret token if none is set in config', function () {
	assertNull(config('maintenance-switch.secret'));

	expect(livewire(ToggleMaintenance::class)->get('secret'))
		->toBeString()
		->toHaveLength(32);
});

it('redirects to the secret URL after activating maintenance mode', function () {
	Config::set('maintenance-switch.secret', 'secret-token');

	livewire(ToggleMaintenance::class)
		->call('toggle')
		->assertRedirect('secret-token')
		->assertNotified(__('maintenance-switch::general.success.title', [
			'status' => __('maintenance-switch::general.activated'),
		]));
});

it('does not perform any redirection after deactivating maintenance mode', function () {
	Artisan::call('down');

	livewire(ToggleMaintenance::class)
		->call('toggle')
		->assertNoRedirect()
		->assertNotified(__('maintenance-switch::general.success.title', [
			'status' => __('maintenance-switch::general.deactivated'),
		]));
});
