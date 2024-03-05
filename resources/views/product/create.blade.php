<x-app-layout title="Create Product">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-xl font-bold mb-4">Create a New Product</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 flex flex-wrap">
                        <div class="w-full md:w-1/2 md:pr-2 mb-4 md:mb-0">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                            <input type="text" id="name" name="name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" autofocus required>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            <input type="number" id="price" name="price" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea id="description" name="description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="5" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Images:</label>
                        <input type="file" id="images" name="images[]" accept="image/*" multiple class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
