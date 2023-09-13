<button
	x-data="{{ json_encode(['visible' => $visible]) }}"
	x-show="visible"
	type="button"
	@class([
		'flex h-10 items-center justify-center gap-3 rounded-lg px-3 py-2 transition',
		'text-white bg-primary-500' => $isDown,
		'text-gray-700 hover:bg-gray-100 focus:bg-gray-100 dark:text-gray-200 dark:hover:bg-white/5 dark:focus:bg-white/5' => !$isDown,
	 ])
	wire:click="toggle"
	wire:loading.attr="disabled"
	wire:loading.class="opacity-50"
	x-tooltip.raw="{{ __('maintenance-switch::general.tooltip', [
		'action' => $isDown ? __('maintenance-switch::general.deactivate') : __('maintenance-switch::general.activate')
   ]) }}"
>
	<x-filament::icon :icon="config('maintenance-switch.icon') ?? 'heroicon-m-beaker'" class="h-5 w-5" />

	@unless(config('maintenance-switch.tiny_toggle'))
		<span>{{ $isDown ? __('maintenance-switch::general.down') : __('maintenance-switch::general.up') }}</span>
	@endif
</button>
