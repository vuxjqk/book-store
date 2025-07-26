<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <nav class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">{{ __('Book Management') }}</li>
            </ol>
        </nav>

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ __('Book Management') }}</h1>
                    <p class="text-gray-600 mt-1">{{ __('List of all books in the system') }}</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                        <i class="fas fa-download mr-2"></i>{{ __('Export to Excel') }}
                    </button>
                    <a href="{{ route('books.create') }}"
                        class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>{{ __('Add New Book') }}
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-filter mr-2 text-blue-500"></i>{{ __('Filters') }}
                </h3>
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="search" :value="__('Search')" />
                        <x-text-input id="search" class="block mt-1 w-full" type="search" name="search"
                            :value="$filters['search']" placeholder="{{ __('Book title, author...') }}" />
                    </div>
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <x-select id="category" class="block mt-1 w-full" name="category_id">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $filters['category_id'] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <x-select id="status" class="block mt-1 w-full" name="status">
                            @php
                                $statusConfig = [
                                    'active' => __('Active'),
                                    'inactive' => __('Inactive'),
                                    'out_of_stock' => __('Out of Stock'),
                                    'discontinued' => __('Discontinued'),
                                ];
                            @endphp
                            <option value="">{{ __('All Statuses') }}</option>
                            @foreach ($statusConfig as $value => $label)
                                <option value="{{ $value }}"
                                    {{ $filters['status'] == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>{{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">{{ __('Total Books') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $books->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">{{ __('Active') }}</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $books->where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">{{ __('Out of Stock') }}</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $books->where('status', 'out_of_stock')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <i class="fas fa-warehouse text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">{{ __('Total Stock') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $books->sum('stock') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list mr-2 text-green-500"></i>{{ __('Book List') }}
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <x-checkbox-input id="select-all"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Book Information') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Categories') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Price') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Stock') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($books as $book)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-checkbox-input
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 row-checkbox" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-16 w-12 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $book->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ __('Author') }}:
                                                    {{ $book->author }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ __('Publishing House') }}: {{ $book->publishing_house }} |
                                                    {{ $book->page_number }} {{ __('pages') }} |
                                                    {{ $book->size }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($book->categories->count() > 0)
                                            @foreach ($book->categories as $category)
                                                <span
                                                    class="block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mb-1">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                                {{ __('Uncategorized') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ number_format($book->current_price, 0, ',', '.') }} VNĐ</div>
                                        @if ($book->original_price > $book->current_price)
                                            <div class="text-sm text-gray-500 line-through">
                                                {{ number_format($book->original_price, 0, ',', '.') }} VNĐ</div>
                                            <div class="text-sm text-red-600">
                                                -{{ number_format((($book->original_price - $book->current_price) / $book->original_price) * 100, 1) }}%
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $book->stock }} {{ __('items') }}
                                        </div>
                                        @if ($book->stock < 10 && $book->stock > 0)
                                            <div class="text-sm text-yellow-600">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ __('Low Stock') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusConfig = [
                                                'active' => [
                                                    'text' => __('Active'),
                                                    'class' => 'bg-green-100 text-green-800',
                                                    'icon' => 'fa-check-circle',
                                                ],
                                                'inactive' => [
                                                    'text' => __('Inactive'),
                                                    'class' => 'bg-yellow-100 text-yellow-800',
                                                    'icon' => 'fa-pause-circle',
                                                ],
                                                'out_of_stock' => [
                                                    'text' => __('Out of Stock'),
                                                    'class' => 'bg-red-100 text-red-800',
                                                    'icon' => 'fa-exclamation-circle',
                                                ],
                                                'discontinued' => [
                                                    'text' => __('Discontinued'),
                                                    'class' => 'bg-gray-100 text-gray-800',
                                                    'icon' => 'fa-times-circle',
                                                ],
                                            ];
                                            $status = $statusConfig[$book->status] ?? [
                                                'text' => __('Unknown'),
                                                'class' => 'bg-gray-100 text-gray-800',
                                                'icon' => 'fa-question-circle',
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $status['class'] }}">
                                            <i class="fas {{ $status['icon'] }} mr-1"></i>
                                            {{ $status['text'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('books.show', $book->id) }}"
                                                class="text-blue-600 hover:text-blue-900"
                                                title="{{ __('View Details') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900"
                                                title="{{ __('Edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="text-red-600 hover:text-red-900 delete-btn"
                                                data-delete-url="{{ route('books.destroy', $book) }}"
                                                title="{{ __('Delete') }}">
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
                        <span>{{ __('Showing') }}</span>
                        <x-select class="mx-2 px-2 py-1 border border-gray-300 rounded w-16" name="per_page">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                        </x-select>
                        <span>{{ __('of') }} {{ $books->total() }} {{ __('results') }}</span>
                    </div>
                    <div class="flex space-x-2">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </main>

        <!-- Bulk Actions Modal -->
        <div id="bulkActionsModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96">
                <h3 class="text-lg font-semibold mb-4">{{ __('Bulk Actions') }}</h3>
                <div class="space-y-2">
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-edit mr-2"></i>{{ __('Bulk Edit') }}
                    </button>
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                        <i class="fas fa-toggle-on mr-2"></i>{{ __('Change Status') }}
                    </button>
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded text-red-600">
                        <i class="fas fa-trash mr-2"></i>{{ __('Delete Selected') }}
                    </button>
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="closeBulkModal"
                        class="px-4 py-2 text-gray-600 hover:text-gray-800">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Bulk Selection Handling
                const selectAllCheckbox = document.getElementById('select-all');
                const rowCheckboxes = document.querySelectorAll('.row-checkbox');
                const bulkModal = document.getElementById('bulkActionsModal');
                const closeBulkModal = document.getElementById('closeBulkModal');

                selectAllCheckbox.addEventListener('change', () => {
                    rowCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                    toggleBulkModal();
                });

                rowCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        updateSelectAllState();
                        toggleBulkModal();
                    });
                });

                function updateSelectAllState() {
                    const checkedCount = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
                    selectAllCheckbox.checked = checkedCount === rowCheckboxes.length;
                    selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < rowCheckboxes.length;
                }

                function toggleBulkModal() {
                    const checkedCount = Array.from(rowCheckboxes).filter(cb => cb.checked).length;
                    bulkModal.classList.toggle('hidden', checkedCount === 0);
                }

                // Delete Confirmation
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        if (confirm('{{ __('Are you sure you want to delete this book?') }}')) {
                            // Implement delete action
                            const url = button.dataset.deleteUrl;
                            fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content'),
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
                    });
                });

                // Search and Filter Functionality
                const searchInput = document.getElementById('search');
                const categoryFilter = document.getElementById('category');
                const statusFilter = document.getElementById('status');

                function filterBooks() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const selectedCategory = categoryFilter.value;
                    const selectedStatus = statusFilter.value;

                    // Implement filtering logic (e.g., update query parameters and reload)
                    console.log('Filtering:', {
                        searchTerm,
                        selectedCategory,
                        selectedStatus
                    });
                }

                searchInput.addEventListener('input', filterBooks);
                categoryFilter.addEventListener('change', filterBooks);
                statusFilter.addEventListener('change', filterBooks);

                // Modal Handling
                closeBulkModal.addEventListener('click', () => bulkModal.classList.add('hidden'));
                bulkModal.addEventListener('click', (e) => {
                    if (e.target === bulkModal) bulkModal.classList.add('hidden');
                });
            });
        </script>
    @endpush
</x-app-layout>
