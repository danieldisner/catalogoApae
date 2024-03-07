<x-app-layout title="Product Details">
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselProducts" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($images as $key => $image)
                            <li data-bs-target="#carouselProducts" data-bs-slide-to="{{ $key }}" @if ($key === 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
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
            </div>
            <div class="col-md-6">
                <h2><strong>{{ $product->name }}</strong></h2>
                <p class="lead">{{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <!-- Add more details here if needed -->
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'), {
            interval: 10000, // Set the interval between slides in milliseconds (optional)
            wrap: true // Indicates whether the carousel should cycle when reaching the end (optional)
        });
    });
</script>
