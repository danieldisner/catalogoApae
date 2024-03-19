@guest
        <div class="row">
            <div class="col">
                <button id="viewCartBtn" class="btn btn-primary btn-sm w-100 align-items-center d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart-fill me-2" viewBox="0 0 16 16">
                        <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                    </svg>
                    <span>Ver carrinho<span id="cartCount" </span> </span>
                </button>
            </div>
        </div>
        <div class="mt-2 row" id="cartSection" style="display: none;">
            <div class="col">
                <ul class="list-group" id="cartList">
                    <!-- Cart items will be listed here -->
                </ul>
                <button onclick="sendCartToWhatsApp()" class="btn btn-success btn-sm w-100 align-items-center d-flex justify-content-center buyButton" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-heart-fill me-2" viewBox="0 0 16 16">
                        <path d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                    </svg>
                    <span class="align-middle">Comprar!</span>
                </button>
            </div>
        </div>
    <script>
        document.getElementById('viewCartBtn').addEventListener('click', function() {
            var cartSection = document.getElementById('cartSection');
            cartSection.style.display = cartSection.style.display === 'none' ? 'block' : 'none';
        });
    </script>
@endguest
