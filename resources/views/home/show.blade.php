b<x-guest-layout>
    @php
        // Hàm format tiền tệ
        function formatCurrency($amount)
        {
            return number_format($amount, 0, ',', '.');
        }

        // Hàm tính phần trăm giảm giá
        function calculateDiscount($original, $current)
        {
            if ($original > 0 && $current < $original) {
                return round((($original - $current) / $original) * 100, 1);
            }
            return 0;
        }
    @endphp

    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center space-x-2 text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Trang chủ</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <a href="{{ route('home.index') }}" class="hover:text-blue-600">Tất cả sách</a>
                <i class="fas fa-chevron-right text-sm"></i>
                <span class="text-blue-600">
                    {{ $book->name }}
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Book Image -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div
                        class="book-image h-96 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center rounded-lg overflow-hidden">
                        <i class="fas fa-book-open text-8xl text-white"></i>
                    </div>
                    <div class="mt-4 flex justify-center space-x-4">
                        <button
                            class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-cart-plus mr-2"></i>Thêm vào giỏ
                        </button>
                        <button
                            class="bg-gray-200 text-gray-600 px-6 py-3 rounded hover:bg-gray-300 transition duration-300">
                            <i class="far fa-heart mr-2"></i>Yêu thích
                        </button>
                    </div>
                </div>
            </div>

            <!-- Book Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ $book->name }}
                    </h1>
                    <p class="text-gray-600 text-sm mb-2">
                        Tác giả:
                        <span class="font-semibold">
                            {{ $book->author }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-sm mb-2">
                        Nhà xuất bản:
                        <span class="font-semibold">
                            {{ $book->publishing_house }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-sm mb-2">
                        Ngôn ngữ:
                        <span class="font-semibold">
                            {{ $book->language }}
                        </span>
                    </p>
                    <p class="text-gray-600 text-sm mb-4">
                        Tình trạng:
                        <span class="font-semibold text-green-600">
                            {{ $book->status }}
                        </span>
                    </p>
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="text-gray-500 text-sm ml-2">(4.8) 89 đánh giá</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="text-red-500 font-bold text-2xl">
                            {{ formatCurrency($book->current_price) }}₫
                        </span>
                        <span class="text-gray-400 line-through text-sm ml-2">
                            {{ formatCurrency($book->original_price) }}₫
                        </span>
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                            -{{ calculateDiscount($book->original_price, $book->current_price) }}%
                        </span>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Mô tả</h3>
                        <p class="text-gray-600">
                            {{ $book->description }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Thông tin chi tiết</h3>
                        <ul class="text-gray-600 space-y-2">
                            <li><span class="font-semibold">Số trang:</span> {{ $book->page_number }}</li>
                            <li><span class="font-semibold">Kích thước:</span> {{ $book->size }}</li>
                            <li><span class="font-semibold">Năm xuất bản:</span> {{ $book->year_of_publication }}</li>
                            <li><span class="font-semibold">Loại bìa:</span> {{ $book->cover_type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments and Reviews Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Bình luận & Đánh giá</h2>

            <!-- Review Form -->
            <form id="review-form" class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Viết đánh giá của bạn</h3>
                <div class="mb-4">
                    <label class="block text-gray-600 mb-2">Đánh giá:</label>
                    <div class="star-rating flex space-x-1 text-gray-400" id="starRating">
                        <i class="fas fa-star" data-value="1"></i>
                        <i class="fas fa-star" data-value="2"></i>
                        <i class="fas fa-star" data-value="3"></i>
                        <i class="fas fa-star" data-value="4"></i>
                        <i class="fas fa-star" data-value="5"></i>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="reviewName" class="block text-gray-600 mb-2">Tên:</label>
                    <input type="text" id="reviewName"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        placeholder="Nhập tên của bạn">
                </div>
                <div class="mb-4">
                    <label for="reviewComment" class="block text-gray-600 mb-2">Bình luận:</label>
                    <textarea id="reviewComment" name="comment"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" rows="4"
                        placeholder="Nhập bình luận của bạn"></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-300">
                    Gửi đánh giá
                </button>
            </form>

            <!-- Comments List -->
            <div id="commentsList" class="space-y-4">
                <div class="comment-card bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-500 text-sm ml-2">Nguyễn Văn A</span>
                        <span class="text-gray-400 text-sm ml-auto">2025-07-15</span>
                    </div>
                    <p class="text-gray-600">Cuốn sách rất hay, cung cấp nhiều bài học quý giá về cách giao tiếp và xây
                        dựng mối quan hệ. Rất đáng đọc!</p>
                </div>
                <div class="comment-card bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="text-gray-500 text-sm ml-2">Trần Thị B</span>
                        <span class="text-gray-400 text-sm ml-auto">2025-07-10</span>
                    </div>
                    <p class="text-gray-600">Nội dung sâu sắc, nhưng một số phần hơi dài dòng. Dù sao vẫn là một cuốn
                        sách tuyệt vời!</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('review-form');

                form.addEventListener('submit', async function(e) {
                    e.preventDefault(); // Ngăn form submit mặc định (refresh trang)

                    const content = document.getElementById('reviewComment').value;
                    const url = "{{ route('reviews.store', ['bookId' => $book->id]) }}";

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                content
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            location.reload();
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
            // Star rating functionality
            // const stars = document.querySelectorAll('#starRating .fa-star');
            // let selectedRating = 0;

            // stars.forEach(star => {
            //     star.addEventListener('click', function() {
            //         selectedRating = parseInt(this.dataset.value);
            //         stars.forEach(s => {
            //             s.classList.toggle('active', parseInt(s.dataset.value) <= selectedRating);
            //         });
            //     });
            // });

            // // Submit review
            // document.getElementById('submitReview').addEventListener('click', function() {
            //     const name = document.getElementById('reviewName').value.trim();
            //     const comment = document.getElementById('reviewComment').value.trim();

            //     if (!name || !comment || selectedRating === 0) {
            //         alert('Vui lòng nhập tên, bình luận và chọn số sao đánh giá.');
            //         return;
            //     }

            //     const commentsList = document.getElementById('commentsList');
            //     const commentCard = document.createElement('div');
            //     commentCard.className = 'comment-card bg-gray-50 p-4 rounded-lg';

            //     const starIcons = Array.from({
            //             length: 5
            //         }, (_, i) =>
            //         `<i class="fas fa-star ${i < selectedRating ? 'text-yellow-400' : 'text-gray-400'}"></i>`
            //     ).join('');

            //     commentCard.innerHTML = `
    //     <div class="flex items-center mb-2">
    //         <div class="text-yellow-400">
    //             ${starIcons}
    //         </div>
    //         <span class="text-gray-500 text-sm ml-2">${name}</span>
    //         <span class="text-gray-400 text-sm ml-auto">${new Date().toLocaleDateString('vi-VN')}</span>
    //     </div>
    //     <p class="text-gray-600">${comment}</p>
    // `;

            //     commentsList.prepend(commentCard);

            //     // Reset form
            //     document.getElementById('reviewName').value = '';
            //     document.getElementById('reviewComment').value = '';
            //     stars.forEach(s => s.classList.remove('active'));
            //     selectedRating = 0;
            // });
        </script>
    @endpush
</x-guest-layout>
