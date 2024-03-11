<!-- resources/views/image/show.blade.php -->

<x-app-layout title="Show Image">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Show Image</h2>
                <img src="{{ $imageUrl }}" alt="Generated Image" class="w-full">
            </div>
        </div>
    </div>
</x-app-layout>
