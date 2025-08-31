<form wire:submit.prevent="save">
    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="w-full md:w-2/3 space-y-4">
            <div>
                <flux:field>
                    <flux:label>
                        Zaměstnanec *
                    </flux:label>

                    <flux:select wire:model="employee">
                        <flux:select.option value="0" disabled>Zaměstnanec</flux:select.option>
                        @foreach ($employees as $employee)
                            <flux:select.option id="{{ $employee->id }}" value="{{ $employee->id }}">
                                {{ $employee->name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                </flux:field>
            </div>
            <div>
                <flux:field>
                    <flux:label>Datum platby *</flux:label>

                    <flux:input id="payment_date" type="date" wire:model="payment_date" />

                    <flux:error name="payment_date" />
                </flux:field>
            </div>
            <div>
                <flux:field>
                    <flux:label>Částka (Kč) *</flux:label>
                    <flux:input.group>
                        <flux:input id="amount" type="number" step="0.01" wire:model="amount" />
                        <flux:input.group.suffix>Kč</flux:input.group.suffix>
                    </flux:input.group>
                    <flux:error name="amount" />
                </flux:field>
            </div>
        </div>
    </div>


    <flux:text class="mt-2">* Povinné pole</flux:text>

    <flux:button class="cursor-pointer mt-2" type="submit" variant="primary">
        {{ $isEditMode ? 'Uložit změny' : 'Přidat' }}
    </flux:button>
</form>