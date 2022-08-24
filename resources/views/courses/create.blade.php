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
                    Register a new course
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
    <form method="post" action="{{ route('storeCourse') }}" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @csrf
        <div class="flex flex-col">
            <div class="-mt-px">
                <label for="course_name" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Name') }}
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="course_name" name="course_name" class="form-input block w-full sm:text-sm sm:leading-5" />
                </div>
            </div>
            <div class="-mt-px">
                <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Description') }}
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <textarea id="description" name="description" class="form-input block w-full sm:text-sm sm:leading-5" /></textarea>
                </div>
            </div>
            <div class="-mt-px">
                <label for="year" class="block text-sm font-medium leading-5 text-gray-700">
                    {{ __('Period') }}
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="education" name="education" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="example: Software Developer or SD"/>
                    <input id="year" name="year" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="year"/>
                    <input id="semester" name="semester" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="semester"/>
                    <input id="period" name="period" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="period"/>
                    <input id="startYear" name="startYear" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="Starting year"/>
                </div>
            </div>
            <button type="submit">Submit</button>



    </form>
</x-app-layout>


