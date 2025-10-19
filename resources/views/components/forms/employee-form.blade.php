<div class="w-full md:w-2/3 mt-2 space-y-4 mb-2">
    <div>
        <flux:field>
            <flux:label>Jméno *
            </flux:label>

            <flux:input id="name" type="text" wire:model="name" />

            <flux:error name="name" />
        </flux:field>
    </div>
    <div>
        <flux:field>
            <flux:label>Hodinová sazba</flux:label>
            <flux:input.group>
                <flux:input id="hour_rate" type="number" wire:model="hour_rate" />
                <flux:input.group.suffix>Kč</flux:input.group.prefix>
                    <flux:error name="hour_rate" />
            </flux:input.group>
        </flux:field>
    </div>
</div>
<flux:text class="mb-0">* Povinné pole</flux:text>