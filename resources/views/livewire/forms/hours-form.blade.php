<form wire:submit.prevent="save">
    <div class="w-full md:w-2/3 mt-4 space-y-4">
        <div>
            <flux:field>
                <flux:label>
                    Zaměstnanec *
                </flux:label>

                <flux:select wire:model="employee" wire:change="updateHourRate" placeholder="Vyber zaměstnance">
                    @foreach ($employees as $employee)
                        <flux:select.option id="{{ $employee->id }}" value="{{ $employee->id }}">{{ $employee->nickname ? $employee->nickname : $employee->name }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </flux:field>
        </div>
        <div>
            <flux:field>
                <flux:label>Datum *</flux:label>

                <flux:input id="work_date" type="date" wire:model="work_date" />

                <flux:error name="work_date" />
            </flux:field>
        </div>
        <div>
            <flux:field>
                <flux:label>Začátek *</flux:label>

                <flux:input id="start_time" type="time" wire:model="start_time" />

                <flux:error name="start_time" />
            </flux:field>
        </div>
        <div>
            <flux:field>
                <flux:label>Konec *</flux:label>

                <flux:input id="end_time" type="time" wire:model="end_time" />

                <flux:error name="end_time" />
            </flux:field>
        </div>
        <div>
            <flux:field>
                <flux:label>Popis práce</flux:label>

                <flux:textarea id="description" type="text" wire:model="description" placeholder="Co se dělalo?" />

                <flux:error name="description" />
            </flux:field>
        </div>
        <div>
            <flux:field>
                <flux:label>Hodinová sazba</flux:label>
                <flux:input.group>
                    <flux:input id="hour_rate" type="number" wire:model="hour_rate" />
                    <flux:input.group.suffix>Kč</flux:input.group.suffix>
                </flux:input.group>
                <flux:error name="hour_rate" />
            </flux:field>
        </div>
    </div>
    
    <flux:text class="mt-2">* Povinné pole</flux:text>
    
    <flux:button class="cursor-pointer mt-4" type="submit">
        {{ $isEditMode ? 'Uložit změny' : 'Přidat' }}
    </flux:button>
</form>