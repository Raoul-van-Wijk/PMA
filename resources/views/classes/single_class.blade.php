<x-app-layout>
    <x-slot name="header">
        {{ __('Single class') }}
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Currently viewing: {{ $class->class_name }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    @each('classes.components.student',$students, 'student', 'classes.components.no-students')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
