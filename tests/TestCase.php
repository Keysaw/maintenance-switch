<?php

namespace Brickx\MaintenanceSwitch\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Brickx\MaintenanceSwitch\MaintenanceSwitchServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;

class TestCase extends Orchestra
{
	public function getEnvironmentSetUp($app) : void
	{
		config()->set('database.default', 'testing');

		Artisan::call('up');
	}

	protected function setUp() : void
	{
		parent::setUp();

		Gate::define('toggle-maintenance', fn (User $user) => $user->id === 1);

		Factory::guessFactoryNamesUsing(
			fn (string $modelName) => 'Brickx\\MaintenanceSwitch\\Database\\Factories\\'.class_basename($modelName).'Factory'
		);
	}

	protected function getPackageProviders($app) : array
	{
		return [
			ActionsServiceProvider::class,
			BladeCaptureDirectiveServiceProvider::class,
			BladeHeroiconsServiceProvider::class,
			BladeIconsServiceProvider::class,
			FilamentServiceProvider::class,
			FormsServiceProvider::class,
			InfolistsServiceProvider::class,
			LivewireServiceProvider::class,
			NotificationsServiceProvider::class,
			SupportServiceProvider::class,
			TablesServiceProvider::class,
			WidgetsServiceProvider::class,
			MaintenanceSwitchServiceProvider::class,
		];
	}
}
