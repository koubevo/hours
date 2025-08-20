<div class="border rounded-lg p-8">
    <table class="w-full">
        <colgroup>
            <col class="w-4"/>
            @foreach ($columns as $column)
                <col>
            @endforeach
            <col class="w-10"/>
            <col class="w-10"/>
        </colgroup>
        <thead class="border-b-2 border-gray-500">
            <tr>
                <th class="text-start py-4 ps-2">
                    <flux:heading>#</flux:heading>
                </th>
                @foreach ($columns as $column)
                    <th class="text-start py-4">
                        <flux:heading>
                            {{ $column['label'] }}
                        </flux:heading>
                    </th>
                @endforeach
                <th class="text-start py-4">
                </th>
                <th class="text-start py-4">
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr class="hover:bg-gray-100">
                    <td class="py-3 border-b ps-2">
                        <flux:text>
                            {{ $loop->index + 1 }}
                        </flux:text>
                    </td>
                    @foreach ($columns as $column)
                        <td class="py-3 border-b">
                            <flux:text>
                                @php
                                    $value = data_get($row, $column['key']);
                                @endphp
                                {{ $value }}
                            </flux:text>
                        </td>
                    @endforeach
                    <td class="py-3 border-b text-end pe-2">
                        <a href="{{ route($editRoute, $row->id) }}" class="cursor-pointer inline-flex justify-end w-full">
                            <flux:icon name="pencil" class="size-4"/>
                        </a>
                    </td>
                    <td class="py-3 border-b text-end pe-2">
                        <button class="cursor-pointer inline-flex justify-end w-full">
                            <flux:icon name="trash" class="size-4"/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}">
                        <flux:text>
                            Žádná data k dispozici.
                        </flux:text>
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            @if(collect($columns)->contains(fn($col) => !empty($col['countable'])))
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
                            <th></th>
                        @endif
                    @endforeach
                </tr>
            @endif
        </tfoot>
    </table>
    @if (!empty($rows))
        <flux:text class="mt-4" size="sm">
            Počet výsledků: {{ count($rows) }}.
        </flux:text>
    @endif
</div>
