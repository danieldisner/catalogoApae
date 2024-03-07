let cart = JSON.parse(localStorage.getItem('cart')) || [];

function sendCartToWhatsApp() {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Número do WhatsApp da pessoa
    var phoneNumber = '5547997455910';

    // Construa a mensagem a ser enviada para o WhatsApp
    var message = "Olá, gostaria de fazer um pedido. Aqui estão os itens:\n";

    var TotalPrice = 0;
    cart.forEach(function(item) {
        message += item.quantity + ' ' + item.name + " - R$" + item.price + "\n";
        TotalPrice += item.price;
    });
    message += 'Total da Compra: *R$' + TotalPrice + '*';

    // URL do WhatsApp com a mensagem e o número do WhatsApp
    var whatsappURL = "https://wa.me/" + phoneNumber + "?text=" + encodeURIComponent(message);

    // Redirecionar para o WhatsApp com a mensagem e o número do WhatsApp
    window.location.href = whatsappURL;
}

function addToCart(productId, productName, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let index = cart.findIndex(item => item.id === productId);

    if (index !== -1) {
        // Se o produto já estiver no carrinho, aumente a quantidade e atualize o preço total
        cart[index].quantity++;
        cart[index].totalPrice = cart[index].quantity * cart[index].price;
    } else {
        // Se o produto ainda não estiver no carrinho, adicione-o
        cart.push({ id: productId, name: productName, price: price, quantity: 1, totalPrice: price });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    // Habilitar o botão de comprar após adicionar um item ao carrinho
    $('.buyButton').prop('disabled', false);
    listCart();
}

function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const index = cart.findIndex(item => item.id === productId);

    if (index !== -1) {
        const productName = cart[index].name;
        const price = cart[index].price;
        const quantity = cart[index].quantity;

        // Se houver mais de um item desse produto no carrinho, diminua a quantidade
        if (quantity > 1) {
            cart[index].quantity--;
            cart[index].totalPrice = cart[index].quantity * cart[index].price;
        } else {
            // Se houver apenas um item desse produto no carrinho, remova-o completamente
            cart.splice(index, 1);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        listCart();
    }
}

function listCart() {
    let cartList = document.getElementById('cartList');
    cartList.innerHTML = ''; // Limpar lista anterior

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    cart.forEach(item => {
        let listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.textContent = `${item.name} - Quantidade: ${item.quantity} - Preço Total: ${item.totalPrice}`;
        cartList.appendChild(listItem);
    });
}
// Call listCart to display cart items initially
listCart();
