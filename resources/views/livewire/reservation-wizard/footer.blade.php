<div class="bg-zinc-50 grid place-items-end border-t border-zinc-200 rounded-b-lg p-4">
    <flux:button type="submit" variant="primary">
        <span wire:loading.delay.remove>{{ $button_text }}</span>
        <span wire:loading.delay>Laden...</span>
    </flux:button>
</div>