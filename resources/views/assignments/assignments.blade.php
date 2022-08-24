<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Assignments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if (auth()->user()->hasRole(['teacher', 'admin', 'root']))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('registerAssignment') }}">Create assignment</a>
                </div>
            </div>
        </div>
        @endif

    @include('assignments.assignment-components.assignment')
    </div>
</x-app-layout>
