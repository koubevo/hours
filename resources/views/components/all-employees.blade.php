@props(['employees'])
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($employees as $employee)
        <x-employee-card :employee="$employee" />
    @endforeach
</div>