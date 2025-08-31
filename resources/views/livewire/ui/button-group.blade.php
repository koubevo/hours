<div class="flex flex-wrap gap-2">
    @foreach ($buttons as $button)
        <flux:button href="{{ $button['route'] ?? '#' }}" class="whitespace-nowrap">
            @if (isset($button['icon']))
                <flux:icon class="size-4" name="{{ $button['icon'] }}" />
            @endif
            {{ $button['text'] ?? '' }}
        </flux:button>
    @endforeach
</div>