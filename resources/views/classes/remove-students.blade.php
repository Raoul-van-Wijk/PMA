<x-app-layout>
    <x-slot name="header">
        {{ __('Remove students') }}
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Currently removing students from: {{ $class_name }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <select name="students[]" id="" multiple>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->email }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
