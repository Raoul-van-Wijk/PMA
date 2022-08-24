<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{ route('editAssignmentConfirmed', $id) }}" method="POST">
                @csrf
                <label for="title">Title</label>
                <br>
                <input type="text" name="title" id="" value="{{ $assignment->title }}">
                <br>
                <label for="title">Assignment description</label>
                <br>
                <textarea name="content" id="" cols="134" rows="2">{{ $assignment->content }}</textarea>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
