<div class="border rounded-lg p-8 overflow-x-auto" id="printableTableContainer">
    <table class="w-full min-w-[800px]">
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
            @forelse ($rows as $row)
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
                        <button class="cursor-pointer inline-flex justify-end w-full">
                            <flux:icon name="trash" class="size-4"/>
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
            @if(collect($columns)->contains(fn($col) => !empty($col['countable'])) && count($rows) > 0)
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
                                    {{ collect($rows)->sum('earning') }}
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
    <div class="flex justify-between print:hidden mt-8">
        <div>
            @if (!empty($rows))
                <flux:text class="mt-4" size="sm">
                    Počet výsledků: {{ count($rows) }}.
                </flux:text>
            @endif
        </div>
        <div></div>
        <div class="flex gap-2 justify-end hidden md:block">
            <flux:button class="cursor-pointer" onclick="window.print()">
                <flux:icon name="printer" class="size-4"></flux:icon>
                Vytisknout
            </flux:button>
        </div>
    </div>
</div>
