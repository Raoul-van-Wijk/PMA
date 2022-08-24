<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Assignment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @include('assignments.assignment-components.create-assignment-form')
    </div>
</x-app-layout>
