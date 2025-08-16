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
        <flux:brand href="{{ route('admin.dashboard') }}" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc."
            class="px-2 dark:hidden" />
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}" current>Domů</flux:navlist.item>
            <flux:navlist.group expandable heading="Zaměstnanci" class="hidden lg:grid">
                @foreach($allEmployees as $employee)
                    <flux:navlist.item href="{{ route('employee.show', $employee->id) }}">
                        <flux:badge color="{{ true ? 'green' : 'red' }}" size="sm" style="padding: 4px !important"
                            class="me-2">
                        </flux:badge>
                        {{ !empty($employee->nickname) ? $employee->nickname : $employee->name }}
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
    @fluxScripts
    @livewireScripts
</body>

</html>