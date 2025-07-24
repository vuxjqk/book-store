<x-guest-layout>
    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Trang chủ</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <span class="text-blue-600">Liên hệ</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Liên Hệ Với Chúng Tôi</h1>
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Contact Form -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Gửi Tin Nhắn</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="contactName" class="block text-gray-600 mb-2">Họ và Tên</label>
                            <input type="text" id="contactName"
                                class="input-field w-full px-4 py-2 border border-gray-300 rounded focus:outline-none"
                                placeholder="Nhập họ và tên">
                            <p id="contactNameError" class="error-message mt-1">Tên phải có ít nhất 2 ký tự</p>
                        </div>
                        <div>
                            <label for="contactEmail" class="block text-gray-600 mb-2">Email</label>
                            <input type="email" id="contactEmail"
                                class="input-field w-full px-4 py-2 border border-gray-300 rounded focus:outline-none"
                                placeholder="Nhập email">
                            <p id="contactEmailError" class="error-message mt-1">Vui lòng nhập email hợp lệ</p>
                        </div>
                        <div>
                            <label for="contactSubject" class="block text-gray-600 mb-2">Chủ đề</label>
                            <input type="text" id="contactSubject"
                                class="input-field w-full px-4 py-2 border border-gray-300 rounded focus:outline-none"
                                placeholder="Nhập chủ đề">
                            <p id="contactSubjectError" class="error-message mt-1">Chủ đề không được để trống</p>
                        </div>
                        <div>
                            <label for="contactMessage" class="block text-gray-600 mb-2">Tin nhắn</label>
                            <textarea id="contactMessage" class="input-field w-full px-4 py-2 border border-gray-300 rounded focus:outline-none"
                                rows="5" placeholder="Nhập tin nhắn của bạn"></textarea>
                            <p id="contactMessageError" class="error-message mt-1">Tin nhắn không được để trống</p>
                        </div>
                        <button id="submitContactButton"
                            class="submit-btn bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-paper-plane mr-2"></i>Gửi tin nhắn
                        </button>
                    </div>
                </div>
            </div>

            <!-- Contact Info and Map -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Thông tin liên hệ</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                            <span>123 Đường ABC, Quận 1, TP.HCM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-600 mr-3"></i>
                            <span>0123 456 789</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 mr-3"></i>
                            <span>info@bookstore.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-600 mr-3"></i>
                            <span>Thứ Hai - Chủ Nhật: 8:00 - 20:00</span>
                        </div>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Bản đồ</h2>
                    <div class="w-full h-64 bg-gray-200 rounded">
                        <!-- Placeholder for Google Maps iframe -->
                        <iframe class="w-full h-full rounded"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.447404508228!2d106.698084314623!3d10.776389692319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f38f8e112df%3A0x63a6e50c43977443!2sHo%20Chi%20Minh%20City%2C%20Vietnam!5e0!3m2!1sen!2s!4v1634567890123!5m2!1sen!2s"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Load cart data
            function loadCart() {
                return JSON.parse(localStorage.getItem('cart') || '[]');
            }

            // Update cart count
            function updateCartCount() {
                const cart = loadCart();
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                document.getElementById('cartCount').textContent = totalItems;
            }

            // Validation functions
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

            // Pre-fill form with user data
            function prefillForm() {
                const user = JSON.parse(localStorage.getItem('user') || '{}');
                if (user.name) document.getElementById('contactName').value = user.name;
                if (user.email) document.getElementById('contactEmail').value = user.email;
            }

            // Handle form submission
            document.getElementById('submitContactButton').addEventListener('click', () => {
                clearErrors();
                const name = document.getElementById('contactName').value.trim();
                const email = document.getElementById('contactEmail').value.trim();
                const subject = document.getElementById('contactSubject').value.trim();
                const message = document.getElementById('contactMessage').value.trim();
                let isValid = true;

                if (name.length < 2) {
                    isValid = showError('contactNameError', 'Tên phải có ít nhất 2 ký tự');
                }
                if (!validateEmail(email)) {
                    isValid = showError('contactEmailError', 'Vui lòng nhập email hợp lệ');
                }
                if (!subject) {
                    isValid = showError('contactSubjectError', 'Chủ đề không được để trống');
                }
                if (!message) {
                    isValid = showError('contactMessageError', 'Tin nhắn không được để trống');
                }

                if (isValid) {
                    const inquiries = JSON.parse(localStorage.getItem('inquiries') || '[]');
                    inquiries.push({
                        id: inquiries.length + 1,
                        name,
                        email,
                        subject,
                        message,
                        date: new Date().toLocaleString('vi-VN', {
                            timeZone: 'Asia/Ho_Chi_Minh'
                        })
                    });
                    localStorage.setItem('inquiries', JSON.stringify(inquiries));
                    alert('Tin nhắn đã được gửi thành công! Chúng tôi sẽ liên hệ với bạn sớm.');
                    document.getElementById('contactName').value = '';
                    document.getElementById('contactEmail').value = '';
                    document.getElementById('contactSubject').value = '';
                    document.getElementById('contactMessage').value = '';
                    clearErrors();
                }
            });

            // Initialize page
            prefillForm();
            updateCartCount();
        </script>
    @endpush
</x-guest-layout>
