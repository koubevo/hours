<div class="flex gap-2">
    @foreach ($buttons as $button)
        <flux:button href="{{ $button['route'] ?? '#' }}">
            @if (isset($button['icon']))
                <flux:icon class="size-4" name="{{ $button['icon'] }}" />
            @endif
            {{ $button['text'] ?? '' }}
        </flux:button>
    @endforeach
</div>