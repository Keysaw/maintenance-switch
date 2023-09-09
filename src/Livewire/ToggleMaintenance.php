<?php

namespace Brickx\MaintenanceSwitch\Livewire;

use Brickx\MaintenanceSwitch\Jobs\ToggleMaintenanceJob;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Livewire\Component;

class ToggleMaintenance extends Component
{
	public bool $isDown;
	public string $secret;
	public int|bool $refresh;
	public bool $visible;

	public function mount() : void
	{
		$this->isDown = app()->isDownForMaintenance();
		$this->secret = config('maintenance-switch.secret') ?: Str::random(32);
		$this->refresh = config('maintenance-switch.refresh', false);
		$this->visible = $this->getVisibility();
	}

	public function getVisibility() : bool
	{
		if (($user = auth()->user()) === null) {
			return false;
		}

		if ($permissions = config('maintenance-switch.permissions')) {
			return $user->can($permissions);
		}

		if (method_exists($user, 'hasRole') && $role = config('maintenance-switch.role')) {
			return $user->hasRole($role);
		}

		return true;
	}

	public function toggle() : ?Redirector
	{
		ToggleMaintenanceJob::dispatch($this->secret, $this->refresh);

		$this->isDown = app()->isDownForMaintenance();

		Notification::make()
			->title(__('maintenance-switch::general.success.title', [
				'status' => $this->isDown ? __('maintenance-switch::general.activated') : __('maintenance-switch::general.deactivated'),
			]))
			->body($this->isDown
				? __('maintenance-switch::general.success.body.down', ['secret' => $this->secret])
				: __('maintenance-switch::general.success.body.up')
			)
			->seconds($this->isDown ? 12 : 6)
			->success()
			->send();

		return $this->isDown ? redirect($this->secret) : null;
	}

	public function render() : View
	{
		return view('maintenance-switch::livewire.toggle-maintenance');
	}
}
