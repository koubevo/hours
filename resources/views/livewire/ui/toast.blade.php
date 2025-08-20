<div x-data="{ visible: true }" x-init="setTimeout(() => visible = false, 8000)" x-show="visible" x-transition.opacity.duration.300ms
    class="fixed bottom-4 right-4 z-50 max-w-sm w-[28rem] @max-sm:w-[90vw]">
    <flux:callout 
        variant="secondary" 
        inline 
        class="{{ $success ? 'bg-green-100 border-green-500' : 'bg-red-100 border-red-500' }}">
        <flux:callout.heading class="flex gap-2 items-start">
            <flux:icon name="{{ $icon }}" color="green"/>
            {{ $message }} 
        </flux:callout.heading>
        <x-slot name="controls">        
            <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" class="poniter-cursor" />    
        </x-slot>
    </flux:callout>
</div>