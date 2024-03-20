<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css','resources/css/main.css', 'resources/js/app.js', 'resources/css/tailwind.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm">
                    <div class="container px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @isset($success)
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endisset

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Page Content -->
            <main>
                <div class="container px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    document.addEventListener('DOMContentLoaded', function() {
        checkCartEmpty();
    });

    function checkCartEmpty() {
        if (cart.length === 0) {
            document.querySelector('.buyButton').disabled = true;
        } else {
            document.querySelector('.buyButton').disabled = false;
        }
    }

    function sendCartToWhatsApp() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        var phoneNumber = '5547997455910';
        var message = "Olá, gostaria de fazer um pedido. Aqui estão os itens:\n";
        var TotalPrice = 0;
        cart.forEach(function(item) {
            message += item.quantity + ' ' + item.name + " - " + item.totalPrice.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) + "\n";
            TotalPrice += item.totalPrice;
        });
        message += 'Total da Compra: *' + TotalPrice.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) + '*';
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
            listItem.textContent = `Quantidade ${item.quantity} - ${item.name}  : ${item.totalPrice.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}`;
            cartList.appendChild(listItem);
        });
        document.getElementById('cartCount').innerHTML = cart.length == 0 ? '' : ' (' + cart.length + ') ';
    }
    listCart();
</script>
