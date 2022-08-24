<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit schedule') }}
        </h2>
    </x-slot>
    <div>
        @include('schedules.schedule-components.update-form')
    </div>
</x-app-layout>
