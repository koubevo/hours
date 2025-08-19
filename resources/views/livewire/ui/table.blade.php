<div class="border rounded-lg p-8">
    <table class="w-full">
        <thead class="border-b-2 border-gray-500">
            <tr>
                <th class="text-start py-4">
                    <flux:heading>#</flux:heading>
                </th>
                @foreach ($columns as $column)
                    <th class="text-start py-4">
                        <flux:heading>
                            {{ $column['label'] }}
                        </flux:heading>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td class="py-3 border-b">
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
                        <flux:heading class="text-start py-3">
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
            Nalezeno {{ count($rows) }} výsledků.
        </flux:text>
    @endif
</div>
