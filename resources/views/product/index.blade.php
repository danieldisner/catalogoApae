<x-app-layout title="Products">
    @auth
        <a href="{{ route('products.create') }}" class="mb-2 btn btn-dark">Add Product</a>
    @endauth
    <ul class="list-group">
        @foreach ($products as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('show', $product->id) }}" class="link-underline-light">
                    <img class="me-3" src="{{ asset('storage/' . ($product->images->isNotEmpty() ? $product->images->first()->path : 'default.jpg')) }}" width="60px">
                </a>
                <a href="{{ route('show', $product->id) }}" class="link-underline-light">
                    <span class="align-middle">{{ $product->name }}</span>
                </a>
                <a href="{{ route('show', $product->id) }}" class="link-underline-light">
                    <span class="d-flex"><strong>{{ money($product->price,'BRL') }}</strong></span>
                </a>
                @auth
                    <span class="d-flex">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="post" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </span>
                @endauth
                @guest
                <span class="d-flex">
                    <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})" class="btn btn-success btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z"/>
                        </svg>
                    </button>
                    <button onclick="removeFromCart({{ $product->id }})" class="btn btn-danger btn-sm ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z"/>
                        </svg>
                    </button>
                </span>
                @endguest
            </li>
        @endforeach
    </ul>
    <ul>
        {{ $products->links() }}
    </ul>
    @guest
    <ul>
        <button onclick="sendCartToWhatsApp()" class="btn btn-success btn-sm w-100 align-items-center d-flex justify-content-center buyButton" disabled>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart-fill me-2" viewBox="0 0 16 16">
                <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
            </svg>
            <span class="align-middle">Comprar!</span>
        </button>
    </ul>
    <h2 class="mt-4">Cart</h2>
    <ul class="list-group" id="cartList">
        <!-- Cart items will be listed here -->
    </ul>
    @endguest
</x-pp>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    document.addEventListener('DOMContentLoaded', function() {
        checkCartEmpty();
    });

    function checkCartEmpty() {
        if (cart.length === 0) {
            document.querySelector('.buyButton').disabled = true;
        }
    }

    function sendCartToWhatsApp() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        var phoneNumber = '5547997455910';
        var message = "Olá, gostaria de fazer um pedido. Aqui estão os itens:\n";
        var TotalPrice = 0;
        cart.forEach(function(item) {
            message += item.quantity + ' ' + item.name + " - R$" + item.price + "\n";
            TotalPrice += item.price;
        });
        message += 'Total da Compra: *R$' + TotalPrice + '*';
        var whatsappURL = "https://wa.me/" + phoneNumber + "?text=" + encodeURIComponent(message);
        window.location.href = whatsappURL;
    }

    function addToCart(productId, productName, price) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let index = cart.findIndex(item => item.id === productId);

        if (index !== -1) {
            cart[index].quantity++;
            cart[index].totalPrice = cart[index].quantity * cart[index].price;
        } else {
            cart.push({ id: productId, name: productName, price: price, quantity: 1, totalPrice: price });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        document.querySelector('.buyButton').disabled = false;
        listCart();
    }

    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const index = cart.findIndex(item => item.id === productId);

        if (index !== -1) {
            const quantity = cart[index].quantity;

            if (quantity > 1) {
                cart[index].quantity--;
                cart[index].totalPrice = cart[index].quantity * cart[index].price;
            } else {
                cart.splice(index, 1);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            listCart();
        }

        if (cart.length === 0) {
            document.querySelector('.buyButton').disabled = true;
        }
    }

    function listCart() {
        let cartList = document.getElementById('cartList');
        cartList.innerHTML = '';

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        cart.forEach(item => {
            let listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.textContent = `${item.name} - Quantidade: ${item.quantity} - Preço Total: ${item.totalPrice}`;
            cartList.appendChild(listItem);
        });
    }
    listCart();
</script>
