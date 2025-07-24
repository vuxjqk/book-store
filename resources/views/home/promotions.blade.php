<x-guest-layout>
    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Trang chủ</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <span class="text-blue-600">Khuyến mãi</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Promotional Banner -->
        <div class="banner rounded-lg shadow-md p-8 text-white mb-8">
            <h1 class="text-3xl font-bold mb-4">Ưu Đãi Đặc Biệt Tháng 7!</h1>
            <p class="text-lg mb-4">Giảm giá lên đến 30% cho tất cả sách trong danh mục Văn học và Kỹ năng sống. Nhanh
                tay mua sắm ngay hôm nay!</p>
            <a href="#books"
                class="bg-white text-blue-600 px-6 py-3 rounded hover:bg-gray-100 transition duration-300">Xem ưu
                đãi</a>
        </div>

        <!-- Promotional Books -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8" id="books">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Sách Khuyến Mãi</h2>
            <div id="promoBooksGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
            <div id="noBooksMessage" class="text-center text-gray-600 py-8 hidden">
                <p>Không có sách khuyến mãi nào hiện tại.</p>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Đăng Ký Nhận Ưu Đãi</h2>
            <p class="text-gray-600 mb-4">Đăng ký để nhận thông tin về các chương trình khuyến mãi và ưu đãi độc quyền!
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="email" id="newsletterEmail"
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded focus:outline-none"
                        placeholder="Nhập email của bạn">
                    <p id="newsletterEmailError" class="error-message mt-1">Vui lòng nhập email hợp lệ</p>
                </div>
                <button id="subscribeButton"
                    class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-envelope mr-2"></i>Đăng ký
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Sample book data with promotional discounts
            const initialBooks = [{
                    id: 1,
                    title: "Đắc Nhân Tâm",
                    author: "Dale Carnegie",
                    publisher: "NXB Trẻ",
                    year: 2023,
                    category: "Kỹ năng sống",
                    price: 89000,
                    discountPrice: 62300,
                    stock: 100,
                    image: "fa-book-open"
                },
                {
                    id: 2,
                    title: "Nhà Giả Kim",
                    author: "Paulo Coelho",
                    publisher: "NXB Văn Học",
                    year: 2022,
                    category: "Văn học",
                    price: 67000,
                    discountPrice: 46900,
                    stock: 50,
                    image: "fa-book-open"
                },
                {
                    id: 3,
                    title: "Tư Duy Nhanh Và Chậm",
                    author: "Daniel Kahneman",
                    publisher: "NXB Thế Giới",
                    year: 2021,
                    category: "Khoa học",
                    price: 156000,
                    stock: 30,
                    image: "fa-book-open"
                }
            ];

            // Data management
            function loadBooks() {
                return JSON.parse(localStorage.getItem('books') || JSON.stringify(initialBooks));
            }

            function loadCart() {
                return JSON.parse(localStorage.getItem('cart') || '[]');
            }

            function saveCart(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function saveSubscribers(subscribers) {
                localStorage.setItem('subscribers', JSON.stringify(subscribers));
            }

            // Validation
            function validateEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function showError(elementId, message) {
                const errorElement = document.getElementById(elementId);
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                return false;
            }

            function clearErrors() {
                document.querySelectorAll('.error-message').forEach(error => {
                    error.style.display = 'none';
                });
            }

            // Render promotional books
            function renderPromoBooks() {
                const booksGrid = document.getElementById('promoBooksGrid');
                const noBooksMessage = document.getElementById('noBooksMessage');
                const books = loadBooks().filter(book => book.discountPrice);

                booksGrid.innerHTML = '';
                if (books.length === 0) {
                    noBooksMessage.classList.remove('hidden');
                    booksGrid.classList.add('hidden');
                } else {
                    noBooksMessage.classList.add('hidden');
                    booksGrid.classList.remove('hidden');
                    books.forEach(book => {
                        const bookCard = document.createElement('div');
                        bookCard.className = 'book-card bg-white rounded-lg shadow-md p-4';
                        bookCard.innerHTML = `
                        <div class="w-full h-40 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center rounded mb-4">
                            <i class="fas ${book.image} text-3xl text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">${book.title}</h3>
                        <p class="text-gray-600 text-sm">${book.author}</p>
                        <p class="text-gray-600 text-sm">${book.category}</p>
                        <div class="flex items-center mt-2">
                            <p class="text-lg font-semibold text-gray-800">${book.discountPrice.toLocaleString()}₫</p>
                            <p class="text-sm text-gray-500 line-through ml-2">${book.price.toLocaleString()}₫</p>
                            <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-${Math.round((book.price - book.discountPrice) / book.price * 100)}%</span>
                        </div>
                        <div class="flex justify-between mt-4">
                            <button class="add-to-cart bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300" data-id="${book.id}">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm vào giỏ
                            </button>
                            <a href="book-details.html?id=${book.id}" class="text-blue-600 hover:underline">Xem chi tiết</a>
                        </div>
                    `;
                        booksGrid.appendChild(bookCard);
                    });
                }
            }

            // Update cart count
            function updateCartCount() {
                const cart = loadCart();
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                document.getElementById('cartCount').textContent = totalItems;
            }

            // Add to cart
            document.addEventListener('click', (e) => {
                if (e.target.closest('.add-to-cart')) {
                    const id = parseInt(e.target.closest('.add-to-cart').dataset.id);
                    const books = loadBooks();
                    const book = books.find(b => b.id === id);
                    if (book) {
                        const cart = loadCart();
                        const cartItem = cart.find(item => item.id === id);
                        const priceToUse = book.discountPrice || book.price;
                        if (cartItem) {
                            cartItem.quantity++;
                        } else {
                            cart.push({
                                ...book,
                                price: priceToUse,
                                quantity: 1
                            });
                        }
                        saveCart(cart);
                        updateCartCount();
                        alert(`Đã thêm "${book.title}" vào giỏ hàng!`);
                    }
                }
            });

            // Newsletter signup
            document.getElementById('subscribeButton').addEventListener('click', () => {
                clearErrors();
                const email = document.getElementById('newsletterEmail').value.trim();
                if (!validateEmail(email)) {
                    showError('newsletterEmailError', 'Vui lòng nhập email hợp lệ');
                    return;
                }

                const subscribers = JSON.parse(localStorage.getItem('subscribers') || '[]');
                if (subscribers.includes(email)) {
                    alert('Email này đã được đăng ký!');
                } else {
                    subscribers.push(email);
                    saveSubscribers(subscribers);
                    alert('Đăng ký nhận ưu đãi thành công!');
                    document.getElementById('newsletterEmail').value = '';
                }
            });

            // Initialize page
            renderPromoBooks();
            updateCartCount();
        </script>
    @endpush
</x-guest-layout>
