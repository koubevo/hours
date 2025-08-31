<div class="border rounded-lg p-8 overflow-x-auto" id="printableTableContainer">
    @if ($showMonthSelector)
        <div class="flex items-center justify-between gap-4 mb-6 print:hidden">
            <div></div>
            <div class="flex items-center gap-2">
                <flux:select wire:model.live="selectedMonth" name="selectedMonth" wire:key="month-select">
                    <flux:select.option value="">Vše</flux:select.option>
                    @php
                        $availableMonths = collect($rows)
                            ->filter(fn($r) => !empty($r->work_date))
                            ->map(fn($r) => \Carbon\Carbon::parse($r->work_date)->format('Y-m'))
                            ->unique()
                            ->sortDesc()
                            ->values();
                    @endphp
                    @foreach ($availableMonths as $ym)
                        <flux:select.option value="{{ $ym }}">{{ Str::ucfirst(\Carbon\Carbon::createFromFormat('Y-m-d', $ym.'-01')->locale('cs')->translatedFormat('F Y')) }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
        </div>
    @endif

    @php
        $displayRows = $rows;
        if (!empty($selectedMonth)) {
            $displayRows = collect($rows)->filter(function ($r) use ($selectedMonth) {
                try {
                    return \Carbon\Carbon::parse($r->work_date)->format('Y-m') === $selectedMonth;
                } catch (\Throwable $e) {
                    return false;
                }
            })->values();
        }
    @endphp
    <table class="w-full min-w-[800px] print:min-w-[200px]">
        <colgroup>
            <col class="w-4"/>
            @foreach ($columns as $column)
                <col class="{{ isset($column['print_only']) && $column['print_only'] ? 'hidden print:table-column' : '' }}">
            @endforeach
            <col class="w-10 print:hidden"/>
            <col class="w-10 print:hidden"/>
        </colgroup>
        <thead class="border-b-2 border-gray-500">
            <tr>
                <th class="text-start py-4 px-2">
                    <flux:heading>#</flux:heading>
                </th>
                @foreach ($columns as $column)
                    <th class="text-start py-4 {{ isset($column['print_only']) && $column['print_only'] ? 'hidden print:table-cell' : '' }}">
                        <flux:heading>
                            {{ $column['label'] }}
                        </flux:heading>
                    </th>
                @endforeach
                <th class="text-start py-4 print:hidden"></th>
                <th class="text-start py-4 print:hidden"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($displayRows as $row)
                <tr class="hover:bg-gray-100 print:hover:bg-transparent">
                    <td class="py-3 border-b ps-2">
                        <flux:text>
                            {{ $loop->index + 1 }}
                        </flux:text>
                    </td>
                    @foreach ($columns as $column)
                        <td class="py-3 border-b {{ isset($column['print_only']) && $column['print_only'] ? 'hidden print:table-cell' : '' }}">
                            <flux:text>
                                @php
                                    $value = data_get($row, $column['key']);
                                @endphp
                                @if (isset($column['route']))
                                    <a href="{{ route($column['route'], $row['employee_id']) }}" class="hover:text-gray-800">
                                        {{ $value }}    
                                    </a>
                                @elseif(isset($column['shorten']) && $column['shorten'])
                                    @php
                                        $shortValue = Str::limit($value, 30, '...');
                                    @endphp
                                    <span title="{{ $value }}">{{ $shortValue }}</span>
                                @elseif (isset($column['status_color']) && $column['status_color'])
                                    @if ($value === App\Enum\HoursStatus::Completed->value)
                                        <flux:badge size="sm" style="padding: 4px !important; background-color: #16a34a;"
                                            class="me-2 mb-0.5 opacity-70">
                                        </flux:badge>      
                                    @else
                                        <flux:badge color="amber" size="sm" style="padding: 4px !important; background-color: #f59e0b;"
                                            class="me-2 mb-0.5 opacity-70">
                                        </flux:badge>                                 
                                    @endif
                                @else
                                    {{ $value }}                                    
                                @endif
                            </flux:text>
                        </td>
                    @endforeach
                    <td class="py-3 border-b text-end pe-2 print:hidden">
                        <a href="{{ route($editRoute, $row->id) }}" class="cursor-pointer inline-flex justify-end w-full">
                            <flux:icon name="pencil" class="size-4"/>
                        </a>
                    </td>
                    <td class="py-3 border-b text-end pe-2 print:hidden">
                        <button class="cursor-pointer inline-flex justify-end w-full" wire:click="confirmDelete({{ $row->id }})">
                            <flux:icon name="trash" class="size-4 hover:text-red-500"/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="py-3 ps-2">
                        <flux:text>
                            Žádná data k dispozici.
                        </flux:text>
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            @if(collect($columns)->contains(fn($col) => !empty($col['countable'])) && count($displayRows) > 0)
                <tr>
                    <th>
                        <flux:heading class="text-start py-3 ps-2">
                            Celkem
                        </flux:heading>
                    </th>
                    @foreach ($columns as $column)
                        @if (isset($column['countable']) && $column['countable'])
                            <th class="text-start py-3">
                                <flux:heading>
                                    {{ collect($displayRows)->sum('earning') }}
                                </flux:heading>
                            </th>
                        @else
                            <th class="{{ isset($column['print_only']) && $column['print_only'] ? 'hidden print:table-cell' : '' }}"></th>
                        @endif
                    @endforeach
                </tr>
            @endif
        </tfoot>
    </table>    
    <flux:modal name="delete-row" class="md:w-[500px]" wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Smazat záznam?</flux:heading>
            </div>
            @if ($arrayDeleteInformation)   
                <div class="grid grid-cols-[1.5fr_1fr_1fr_1fr] border-t border-b">
                    @foreach (range(1, 4) as $i)
                        <flux:text class="px-2 py-2 border-b">{{ $arrayDeleteInformation['label' . $i] ?? '' }}</flux:text>
                    @endforeach
                    @foreach (range(1, 4) as $i)
                        <flux:text class="px-2 py-2">{{ $arrayDeleteInformation['value' . $i] ?? '' }}</flux:text>
                    @endforeach
                </div>
            @endif
            <div class="flex gap-2">
                <flux:button wire:click="$set('showDeleteModal', false)" class="cursor-pointer">
                    Zrušit
                </flux:button>
                <flux:button wire:click="deleteRow" variant="primary" color="red" class="cursor-pointer">
                    Smazat
                </flux:button>
            </div>
        </div>
    </flux:modal>
    <div class="flex justify-between print:hidden mt-8">
        <div>
            @if (count($displayRows) > 0)
                <flux:text class="mt-4" size="sm">
                    Počet výsledků: {{ count($displayRows) }}.
                </flux:text>
            @endif
        </div>
        <div></div>
        <div class="flex gap-2 justify-end hidden md:block">
            @if (count($displayRows) > 0)
                <flux:button class="cursor-pointer" onclick="window.print()">
                    <flux:icon name="printer" class="size-4"></flux:icon>
                    Vytisknout
                </flux:button>
            @endif
        </div>
    </div>
</div>
