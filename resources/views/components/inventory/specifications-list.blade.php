<div class="grid grid-cols-1 md:grid-cols-{{ $columnCount }} gap-4">
    @foreach($specifications as $key => $value)
        <div class="bg-white rounded-lg shadow p-4">
            <dt class="text-sm font-medium text-gray-500">
                {{ $key }}
            </dt>
            <dd class="mt-1 text-lg font-semibold text-gray-900">
                {{ $value }}
            </dd>
        </div>
    @endforeach
</div>