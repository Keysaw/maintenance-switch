<?php

namespace Brickx\MaintenanceSwitch;

use Brickx\MaintenanceSwitch\Livewire\ToggleMaintenance;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Str;
use Livewire\Livewire;

class MaintenanceSwitchPlugin implements Plugin
{
	public function getId() : string
	{
		return 'maintenance-switch';
	}

	public function register(Panel $panel) : void
	{
		Livewire::component('maintenance-switch::toggle-maintenance', ToggleMaintenance::class);

		$panel->renderHook(
			Str::start(config('maintenance-switch.render_hook') ?? 'global-search.before', 'panels::'),
			fn () => view('maintenance-switch::switcher')
		);
	}

	public function boot(Panel $panel) : void
	{
		//
	}

	public static function make() : static
	{
		return app(static::class);
	}

	public static function get() : static
	{
		/** @var static $plugin */
		$plugin = filament(app(static::class)->getId());

		return $plugin;
	}
}
