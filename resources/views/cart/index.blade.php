<x-guest-layout>
    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Trang chủ</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <span class="text-blue-600">Giỏ Hàng</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Giỏ Hàng</h1>
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div id="cartItems" class="space-y-6">
                        <!-- Cart items will be dynamically added here -->
                    </div>
                    <div id="emptyCartMessage" class="text-center text-gray-600 py-8 hidden">
                        <p>Giỏ hàng của bạn đang trống. <a href="books.php" class="text-blue-600 hover:underline">Tiếp
                                tục mua sắm</a></p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tóm tắt đơn hàng</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Tổng sản phẩm</span>
                            <span id="totalItems">0</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tạm tính</span>
                            <span id="subtotal">0₫</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Phí vận chuyển</span>
                            <span>30.000₫</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-gray-800 font-semibold">
                                <span>Tổng cộng</span>
                                <span id="total">0₫</span>
                            </div>
                        </div>
                        <button id="checkoutButton"
                            class="w-full bg-blue-600 text-white px-4 py-3 rounded hover:bg-blue-700 transition duration-300 mt-4">
                            <i class="fas fa-credit-card mr-2"></i>Thanh Toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Sample cart data (for demonstration)
            const initialCart = [{
                    id: 1,
                    title: "Đắc Nhân Tâm",
                    author: "Dale Carnegie",
                    price: 89000,
                    quantity: 1,
                    image: "fa-book-open"
                },
                {
                    id: 2,
                    title: "Nhà Giả Kim",
                    author: "Paulo Coelho",
                    price: 67000,
                    quantity: 2,
                    image: "fa-book-open"
                },
                {
                    id: 3,
                    title: "Tư Duy Nhanh Và Chậm",
                    author: "Daniel Kahneman",
                    price: 156000,
                    quantity: 1,
                    image: "fa-book-open"
                }
            ];

            // Load cart from localStorage or initialize with sample data
            function loadCart() {
                const savedCart = localStorage.getItem('cart');
                return savedCart ? JSON.parse(savedCart) : initialCart;
            }

            function saveCart(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            // Render cart items
            function renderCart() {
                const cartItemsContainer = document.getElementById('cartItems');
                const emptyCartMessage = document.getElementById('emptyCartMessage');
                const cart = loadCart();

                cartItemsContainer.innerHTML = '';
                if (cart.length === 0) {
                    emptyCartMessage.classList.remove('hidden');
                    cartItemsContainer.classList.add('hidden');
                } else {
                    emptyCartMessage.classList.add('hidden');
                    cartItemsContainer.classList.remove('hidden');
                    cart.forEach(item => {
                        const itemElement = document.createElement('div');
                        itemElement.className = 'cart-item flex items-center border-b border-gray-200 py-4';
                        itemElement.innerHTML = `
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center rounded">
                            <i class="fas ${item.image} text-2xl text-white"></i>
                        </div>
                        <div class="flex-1 ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">${item.title}</h3>
                            <p class="text-gray-600 text-sm">${item.author}</p>
                            <p class="text-gray-600 text-sm">${item.price.toLocaleString()}₫</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="quantity-btn decrease bg-gray-200 text-gray-600 px-2 py-1 rounded" data-id="${item.id}">-</button>
                            <input type="number" value="${item.quantity}" min="1" class="w-12 text-center border border-gray-300 rounded" data-id="${item.id}">
                            <button class="quantity-btn increase bg-gray-200 text-gray-600 px-2 py-1 rounded" data-id="${item.id}">+</button>
                        </div>
                        <div class="ml-4 text-lg font-semibold text-gray-800">${(item.price * item.quantity).toLocaleString()}₫</div>
                        <button class="remove-btn text-gray-500 ml-4" data-id="${item.id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                        cartItemsContainer.appendChild(itemElement);
                    });
                }
                updateSummary();
            }

            // Update order summary
            function updateSummary() {
                const cart = loadCart();
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                const shipping = 30000;
                const total = subtotal + shipping;

                document.getElementById('totalItems').textContent = totalItems;
                document.getElementById('subtotal').textContent = subtotal.toLocaleString() + '₫';
                document.getElementById('total').textContent = total.toLocaleString() + '₫';
                document.getElementById('cartCount').textContent = totalItems;
            }

            // Handle quantity changes
            document.addEventListener('click', (e) => {
                const cart = loadCart();
                const id = parseInt(e.target.dataset.id);

                if (e.target.classList.contains('increase')) {
                    const item = cart.find(item => item.id === id);
                    if (item) {
                        item.quantity++;
                        saveCart(cart);
                        renderCart();
                    }
                }

                if (e.target.classList.contains('decrease')) {
                    const item = cart.find(item => item.id === id);
                    if (item && item.quantity > 1) {
                        item.quantity--;
                        saveCart(cart);
                        renderCart();
                    }
                }

                if (e.target.classList.contains('remove-btn') || e.target.parentElement.classList.contains(
                        'remove-btn')) {
                    const newCart = cart.filter(item => item.id !== id);
                    saveCart(newCart);
                    renderCart();
                }
            });

            // Handle quantity input changes
            document.addEventListener('input', (e) => {
                if (e.target.type === 'number') {
                    const id = parseInt(e.target.dataset.id);
                    const value = parseInt(e.target.value);
                    if (value >= 1) {
                        const cart = loadCart();
                        const item = cart.find(item => item.id === id);
                        if (item) {
                            item.quantity = value;
                            saveCart(cart);
                            renderCart();
                        }
                    }
                }
            });

            // Handle checkout
            document.getElementById('checkoutButton').addEventListener('click', () => {
                const cart = loadCart();
                if (cart.length === 0) {
                    alert('Giỏ hàng của bạn đang trống!');
                } else {
                    alert('Chuyển đến trang thanh toán...');
                    // In production, redirect to checkout page
                    // window.location.href = 'checkout.php';
                }
            });

            // Initialize cart
            renderCart();
        </script>
    @endpush
</x-guest-layout>
