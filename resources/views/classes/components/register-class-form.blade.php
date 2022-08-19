<x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{ route('storeClass') }}" method="POST">
@csrf
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="class_name">
            Class Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="class_name" name="class_name" type="text" placeholder="Enter Class name">
        <button type="submit">Create Class</button>
    </div>
</form>
