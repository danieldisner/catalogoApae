<x-app-layout title="Create Product">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Create a New Product</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full mb-4 md:w-1/2 md:pr-2 md:mb-0">
                            <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Product Name:</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" autofocus required>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <label for="price" class="block mb-2 text-sm font-bold text-gray-700">Price:</label>
                            <input type="number" id="price" name="price" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" step="0.01" min="0.01" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
                        <textarea id="description" name="description" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" rows="5" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block mb-2 text-sm font-bold text-gray-700">Images:</label>
                        <input type="file" id="images" name="images[]" accept="image/*" multiple class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
                    </div>
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Create Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
