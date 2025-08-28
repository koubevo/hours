<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Administrace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable
        class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        <flux:brand href="{{ route('admin.dashboard') }}" logo="{{ asset('storage/logo.png') }}"
            name="{{ env('COMPANY_NAME') }}" class="px-2 dark:hidden" />
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}">Domů</flux:navlist.item>
            <flux:navlist.item icon="plus" href="{{ route('hours.create') }}">Přidat hodiny</flux:navlist.item>
            <flux:navlist.group expandable heading="Zaměstnanci" class="hidden lg:grid">
                @foreach($allEmployees as $employee)
                    @php
                        if ($employee->hasDraftHoursToday()) {
                            $color = '#f59e0b';
                        } elseif ($employee->hasHoursToday()) {
                            $color = '#16a34a';
                        } else {
                            $color = '#ef4444';
                        }
                    @endphp
                    <flux:navlist.item href="{{ route('employee.show', ['employee' => $employee->id]) }}">
                        <div class="flex flex-row justify-between items-center">
                            <div>
                                <flux:badge class="me-2 mb-0.5 opacity-70" size="sm"
                                    style="padding: 4px !important; background-color: {{ $color }};">
                                </flux:badge>
                                {{ $employee->name }}
                            </div>
                        </div>
                    </flux:navlist.item>
                @endforeach
            </flux:navlist.group>
        </flux:navlist>
        <flux:spacer />
        <flux:navlist variant="outline">
            <flux:navlist.item icon="plus" href="{{ route('employee.create') }}">
                Přidat zaměstnance
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
    <flux:main>
        <flux:heading size="xl" level="1">
            @yield('title')
        </flux:heading>
        <flux:separator class="my-2" variant="subtle" />
        @yield('content')
    </flux:main>

    @if (session()->has('success'))
        @livewire('ui.success-toast', [
            'message' => session('success')
        ])
    @endif
    
    @fluxScripts
    @livewireScripts
</body>

</html>