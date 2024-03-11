<x-app-layout title="Generate Image">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Generate Image</h2>
                <form action="{{ route('image.generate') }}" method="post">
                    @csrf <!-- Adiciona o token CSRF -->
                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
                        <textarea id="description" name="description" rows="4" cols="50" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="size" class="block mb-2 text-sm font-bold text-gray-700">Size:</label>
                        <select id="size" name="size" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
                            <option value="sm">Small</option>
                            <option value="md">Medium</option>
                            <option value="lg">Large</option>
                        </select>
                    </div>
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Generate Image</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
