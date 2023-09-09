<?php

namespace Brickx\MaintenanceSwitch;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MaintenanceSwitchServiceProvider extends PackageServiceProvider
{
	public static string $name = 'maintenance-switch';

	public static string $viewNamespace = 'maintenance-switch';

	public function configurePackage(Package $package) : void
	{
		/*
		 * This class is a Package Service Provider
		 *
		 * More info: https://github.com/spatie/laravel-package-tools
		 */
		$package->name(static::$name)
			->hasCommands($this->getCommands())
			->hasInstallCommand(function (InstallCommand $command) {
				$command
					->publishConfigFile()
					->publishMigrations()
					->askToRunMigrations()
					->askToStarRepoOnGitHub('keysaw/maintenance-switch');
			});

		$configFileName = $package->shortName();

		if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
			$package->hasConfigFile();
		}

		if (file_exists($package->basePath('/../database/migrations'))) {
			$package->hasMigrations($this->getMigrations());
		}

		if (file_exists($package->basePath('/../resources/lang'))) {
			$package->hasTranslations();
		}

		if (file_exists($package->basePath('/../resources/views'))) {
			$package->hasViews(static::$viewNamespace);
		}
	}

	public function packageRegistered() : void
	{
	}

	public function packageBooted() : void
	{
		// Asset Registration
		FilamentAsset::register(
			$this->getAssets(),
			$this->getAssetPackageName()
		);

		FilamentAsset::registerScriptData(
			$this->getScriptData(),
			$this->getAssetPackageName()
		);

		// Icon Registration
		FilamentIcon::register($this->getIcons());

		// Handle Stubs
		if (app()->runningInConsole()) {
			foreach (app(Filesystem::class)->files(__DIR__.'/../stubs/') as $file) {
				$this->publishes([
					$file->getRealPath() => base_path("stubs/maintenance-switch/{$file->getFilename()}"),
				], 'maintenance-switch-stubs');
			}
		}
	}

	protected function getAssetPackageName() : ?string
	{
		return 'brickx/maintenance-switch';
	}

	/**
	 * @return array<Asset>
	 */
	protected function getAssets() : array
	{
		return [
			/*AlpineComponent::make('maintenance-switch', __DIR__ . '/../resources/dist/components/maintenance-switch.js'),*/
			/*Css::make('maintenance-switch-styles', __DIR__.'/../resources/dist/maintenance-switch.css'),*/
			/*Js::make('maintenance-switch-scripts', __DIR__.'/../resources/dist/maintenance-switch.js'),*/
		];
	}

	/**
	 * @return array<class-string>
	 */
	protected function getCommands() : array
	{
		return [];
	}

	/**
	 * @return array<string>
	 */
	protected function getIcons() : array
	{
		return [];
	}

	/**
	 * @return array<string>
	 */
	protected function getRoutes() : array
	{
		return [];
	}

	/**
	 * @return array<string, mixed>
	 */
	protected function getScriptData() : array
	{
		return [];
	}

	/**
	 * @return array<string>
	 */
	protected function getMigrations() : array
	{
		return [
			'create_maintenance-switch_table',
		];
	}
}
