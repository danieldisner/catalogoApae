<x-app-layout title="Edit Product">
    <style>
    /* Custom styles for the carousel */
    .carousel {
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        background-color: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente */
    }
    .carousel-item img {
        border-radius: 10px;
        max-height: 100%; /* Ajuste para a altura máxima do carrossel */
        max-width: 100%; /* Ajuste para a largura máxima do carrossel */
        width: auto; /* Mantenha a proporção da imagem */
        height: auto; /* Mantenha a proporção da imagem */
        margin: auto;
        display: block;
        object-fit: contain;
        z-index: 2;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        cursor: pointer;
        border: none;
        line-height: 50px;
        font-size: 20px;
        color: #fff;
        text-align: center;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease;
        z-index: 3; /* Garanta que os controles fiquem acima das imagens */
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: rgba(0, 0, 0, 0.7);
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }
    </style>
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <h2 class="mb-4 text-xl font-bold">Edit Product</h2>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full mb-4 md:w-1/2 md:pr-2 md:mb-0">
                            <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Product Name:</label>
                            <input type="text" id="name" name="name" value="{{ $product->name }}" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" autofocus required>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <label for="price" class="block mb-2 text-sm font-bold text-gray-700">Price:</label>
                            <input type="number" id="price" name="price" value="{{ $product->price }}" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
                        <textarea id="description" name="description" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline" rows="5" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block mb-2 text-sm font-bold text-gray-700">Images:</label>
                        <input type="file" id="images" name="images[]" accept="image/*" multiple class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
                    </div>
                    <!-- Display existing images -->
                    <div id="carouselProducts" class="mb-4 carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item @if ($key === 0) active @endif">
                                    <img class="d-block w-100" src="{{ asset('storage/' . $image->path) }}" alt="Image {{ $key }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- End of existing images display -->
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var carousel = new bootstrap.Carousel(document.querySelector('#carouselProducts'), {
            interval: 10000, // Set the interval between slides in milliseconds (optional)
            wrap: true // Indicates whether the carousel should cycle when reaching the end (optional)
        });
    });
</script>
