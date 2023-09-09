<?php

use Brickx\MaintenanceSwitch\Livewire\ToggleMaintenance;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;

use function Pest\Livewire\livewire;

it('has a default render hook', function () {
	expect(config('maintenance-switch.render_hook'))
		->toBe('global-search.before');
});

test('users can customize the icon', function () {
	expect(config('maintenance-switch.icon'))
		->toBe('heroicon-m-beaker');

	livewire(ToggleMaintenance::class)
		->assertSeeHtml(Blade::render('<x-heroicon-m-beaker class="h-5 w-5" />'));

	Config::set('maintenance-switch.icon', 'heroicon-o-beaker');

	livewire(ToggleMaintenance::class)
		->assertSeeHtml(Blade::render('<x-heroicon-o-beaker class="h-5 w-5" />'));
});

test('users can minify the button', function () {
	expect(config('maintenance-switch.tiny_toggle'))
		->toBeFalse();

	livewire(ToggleMaintenance::class)
		->assertSeeText(__('maintenance-switch::general.up'));

	Config::set('maintenance-switch.tiny_toggle', true);

	livewire(ToggleMaintenance::class)
		->assertDontSeeText(__('maintenance-switch::general.up'));
});
