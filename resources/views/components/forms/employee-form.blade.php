<div class="w-full md:w-2/3 mt-4 space-y-4">
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
            <flux:label>Přezdívka</flux:label>

            <flux:input id="nickname" type="text" wire:model="nickname" />

            <flux:error name="nickname" />
        </flux:field>
    </div>
    <div>
        <flux:field>
            <flux:label>Hodinová sazba</flux:label>

            <flux:input id="hour_rate" type="number" wire:model="hour_rate" />

            <flux:error name="hour_rate" />
        </flux:field>
    </div>
</div>
<flux:text>* Povinné pole</flux:text>