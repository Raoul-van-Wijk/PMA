<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You are on courses page
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(['teacher', 'admin', 'root']))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('registerCourse') }}">Create a new course</a>
                    </div>
                </div>
            </div>
    @endif

    @each('courses.course-components.course-item', $courses, 'course', 'courses.course-components.no-course-item')

</x-app-layout>
