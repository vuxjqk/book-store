<x-app-layout>
    @php
        // Hàm format tiền tệ
        function formatCurrency($amount)
        {
            return number_format($amount, 0, ',', '.') . ' VNĐ';
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

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <nav class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">Trang chủ</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">Quản lý sách</li>
            </ol>
        </nav>

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Quản lý sách</h1>
                    <p class="text-gray-600 mt-1">Danh sách tất cả các sách trong hệ thống</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-download mr-2"></i>Xuất Excel
                    </button>
                    <a href="{{ route('books.create') }}"
                        class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>Thêm sách mới
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-filter mr-2 text-blue-500"></i>Bộ lọc
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                        <input type="text" placeholder="Tên sách, tác giả..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Tất cả danh mục</option>
                            <option value="Văn học">Văn học</option>
                            <option value="Khoa học">Khoa học</option>
                            <option value="Lịch sử">Lịch sử</option>
                            <option value="Kinh tế">Kinh tế</option>
                            <option value="Công nghệ">Công nghệ</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Đang bán</option>
                            <option value="inactive">Tạm ngưng</option>
                            <option value="out_of_stock">Hết hàng</option>
                            <option value="discontinued">Ngừng kinh doanh</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="button"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Tổng sách</p>
                            <p class="text-2xl font-bold text-gray-900">{{ count($books) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Đang bán</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $books->filter(fn($book) => $book->status === 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Hết hàng</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $books->filter(fn($book) => $book->status === 'out_of_stock')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-warehouse text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Tồn kho</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $books->sum('stock') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list mr-2 text-green-500"></i>Danh sách sách
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Thông tin sách
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Giá bán
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tồn kho
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trạng thái
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($books as $book)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-16 w-12 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $book->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Tác giả: {{ $book->author }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    NXB: {{ $book->publishing_house }} |
                                                    {{ $book->page_number }} trang |
                                                    {{ $book->size }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ formatCurrency($book->current_price) }}
                                        </div>
                                        @if ($book->original_price > $book->current_price)
                                            <div class="text-sm text-gray-500 line-through">
                                                {{ formatCurrency($book->original_price) }}
                                            </div>
                                            <div class="text-sm text-red-600">
                                                -{{ calculateDiscount($book->original_price, $book->current_price) }}%
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $book->stock }} cuốn
                                        </div>
                                        @if ($book->stock < 10 && $book->stock > 0)
                                            <div class="text-sm text-yellow-600">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Sắp hết
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            switch ($book->status) {
                                                case 'Đang bán':
                                                    $badge =
                                                        '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Đang bán</span>';
                                                    break;
                                                case 'Tạm ngưng':
                                                    $badge =
                                                        '<span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Tạm ngưng</span>';
                                                    break;
                                                case 'Hết hàng':
                                                    $badge =
                                                        '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Hết hàng</span>';
                                                    break;
                                                case 'Ngừng kinh doanh':
                                                    $badge =
                                                        '<span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Ngừng kinh doanh</span>';
                                                    break;
                                                default:
                                                    $badge =
                                                        '<span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Không xác định</span>';
                                                    break;
                                            }
                                        @endphp

                                        {!! $badge !!}

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-900" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-700">
                        <span>Hiển thị</span>
                        <select class="mx-2 px-2 py-1 border border-gray-300 rounded">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span>trên {{ count($books) }} kết quả</span>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 text-sm text-gray-500 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
                            disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 text-sm text-white bg-blue-600 rounded">1</button>
                        <button
                            class="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">2</button>
                        <button
                            class="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">3</button>
                        <button class="px-3 py-1 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Bulk Actions Modal (Hidden by default) -->
        <div id="bulkActionsModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96">
                <h3 class="text-lg font-semibold mb-4">Thao tác hàng loạt</h3>
                <div class="space-y-2">
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-edit mr-2"></i>Chỉnh sửa hàng loạt
                    </button>
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-toggle-on mr-2"></i>Thay đổi trạng thái
                    </button>
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded text-red-600">
                        <i class="fas fa-trash mr-2"></i>Xóa đã chọn
                    </button>
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="closeBulkModal" class="px-4 py-2 text-gray-600 hover:text-gray-800">Đóng</button>
                </div>
            </div>
        </div>
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" class="flex items-center space-x-4">
                        <div class="flex-1">
                            <x-search-form name="search" value="{{ request('search') }}"
                                placeholder="Tìm kiếm theo tên, slug danh mục..." withButton />
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <x-table striped hover>
                        <x-thead>
                            <x-tr>
                                <x-th>{{ __('id') }}</x-th>
                                <x-th>{{ __('name') }}</x-th>
                                <x-th>{{ __('slug') }}</x-th>
                                <x-th align="center" width="120px">{{ __('action') }}</x-th>
                            </x-tr>
                        </x-thead>
                        <x-tbody>
                            @foreach ($books as $book)
                                <x-tr>
                                    <x-td>{{ $book->id }}</x-td>
                                    <x-td>{{ $book->name }}</x-td>
                                    <x-td>{{ $book->slug }}</x-td>
                                    <x-td align="center">
                                        <x-button-group spacing="tight">
                                            <x-show-button href="{{ route('books.show', $book) }}" />
                                            <x-edit-button href="{{ route('books.edit', $book) }}" />
                                            <x-delete-button
                                                onclick="deleteBook('{{ route('books.destroy', $book) }}')" />
                                        </x-button-group>
                                    </x-td>
                                </x-tr>
                            @endforeach
                        </x-tbody>
                    </x-table>
                </div>
            </div>
        </div> --}}
    </div>

    @push('scripts')
        <script>
            function deleteBook(url) {
                if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            alert('Lỗi không xác định khi xóa.');
                            console.error(error);
                        });
                }
            }

            // Bulk selection handling
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

            selectAllCheckbox.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllState();
                    updateBulkActions();
                });
            });

            function updateSelectAllState() {
                const checkedCount = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
                selectAllCheckbox.checked = checkedCount === rowCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < rowCheckboxes.length;
            }

            function updateBulkActions() {
                const checkedCount = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
                // Here you can show/hide bulk action buttons based on selection
                if (checkedCount > 0) {
                    console.log(`${checkedCount} items selected`);
                }
            }

            // Delete confirmation
            document.querySelectorAll('.fa-trash').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Bạn có chắc chắn muốn xóa sách này?')) {
                        // Handle delete action
                        console.log('Delete confirmed');
                    }
                });
            });

            // Search functionality
            const searchInput = document.querySelector('input[type="text"]');
            const categoryFilter = document.querySelector('select');
            const statusFilter = document.querySelectorAll('select')[1];

            function filterBooks() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
                const selectedStatus = statusFilter.value;

                // Here you would implement the actual filtering logic
                console.log('Filtering:', {
                    searchTerm,
                    selectedCategory,
                    selectedStatus
                });
            }

            searchInput.addEventListener('input', filterBooks);
            categoryFilter.addEventListener('change', filterBooks);
            statusFilter.addEventListener('change', filterBooks);

            // Modal handling
            const bulkModal = document.getElementById('bulkActionsModal');
            const closeBulkModal = document.getElementById('closeBulkModal');

            closeBulkModal.addEventListener('click', function() {
                bulkModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            bulkModal.addEventListener('click', function(e) {
                if (e.target === bulkModal) {
                    bulkModal.classList.add('hidden');
                }
            });
        </script>
    @endpush
</x-app-layout>
