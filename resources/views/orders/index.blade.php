<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Breadcrumb -->
        <nav class="bg-gray-50 px-6 py-3 text-gray-700">
            <ol class="list-reset flex text-sm">
                <li><a href="#" class="text-blue-600 hover:text-blue-800">{{ __('Home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-500">{{ __('Order Management') }}</li>
            </ol>
        </nav>

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ __('Order Management') }}</h1>
                    <p class="text-gray-600 mt-1">{{ __('List of all orders in the system') }}</p>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-filter mr-2 text-blue-500"></i>{{ __('Search & Filter') }}
                </h3>
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="search" :value="__('Search')" />
                        <x-text-input id="search" class="block mt-1 w-full" type="search" name="search"
                            :value="$filters['search'] ?? ''" placeholder="{{ __('Order ID, customer name...') }}" />
                    </div>
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="pending" {{ ($filters['status'] ?? '') == 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}</option>
                            <option value="processing"
                                {{ ($filters['status'] ?? '') == 'processing' ? 'selected' : '' }}>
                                {{ __('Processing') }}</option>
                            <option value="shipped" {{ ($filters['status'] ?? '') == 'shipped' ? 'selected' : '' }}>
                                {{ __('Shipped') }}</option>
                            <option value="delivered"
                                {{ ($filters['status'] ?? '') == 'delivered' ? 'selected' : '' }}>
                                {{ __('Delivered') }}</option>
                            <option value="cancelled"
                                {{ ($filters['status'] ?? '') == 'cancelled' ? 'selected' : '' }}>
                                {{ __('Cancelled') }}</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="order_date" :value="__('From Date')" />
                        <x-text-input id="order_date" class="block mt-1 w-full" type="date" name="order_date"
                            :value="$filters['order_date'] ?? ''" />
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>{{ __('Search') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-shopping-cart mr-2 text-green-500"></i>{{ __('Order List') }}
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Order ID') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Customer') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Order Date') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Total Amount') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @switch($order->status)
                                                @case('pending')
                                                    bg-yellow-100 text-yellow-800
                                                    @break
                                                @case('processing')
                                                    bg-blue-100 text-blue-800
                                                    @break
                                                @case('shipped')
                                                    bg-purple-100 text-purple-800
                                                    @break
                                                @case('delivered')
                                                    bg-green-100 text-green-800
                                                    @break
                                                @case('cancelled')
                                                    bg-red-100 text-red-800
                                                    @break
                                            @endswitch
                                        ">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- View Details Button -->
                                            <button class="text-blue-600 hover:text-blue-900 view-details-btn"
                                                data-order-id="{{ $order->id }}" name="{{ __('View Details') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Confirm Order Button (only for pending/processing orders) -->
                                            @if (in_array($order->status, ['pending', 'processing']))
                                                <button class="text-green-600 hover:text-green-900 confirm-order-btn"
                                                    data-order-id="{{ $order->id }}"
                                                    data-confirm-url="{{ route('orders.confirm', $order->id) }}"
                                                    name="{{ __('Confirm Order') }}">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif

                                            <!-- Cancel Order Button (only for pending/processing orders) -->
                                            @if (in_array($order->status, ['pending', 'processing']))
                                                <button class="text-red-600 hover:text-red-900 cancel-order-btn"
                                                    data-order-id="{{ $order->id }}"
                                                    data-cancel-url="{{ route('orders.cancel', $order->id) }}"
                                                    name="{{ __('Cancel Order') }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        {{ __('Showing') }} {{ $orders->firstItem() }} {{ __('to') }}
                        {{ $orders->lastItem() }} {{ __('of') }} {{ $orders->total() }}
                        {{ __('results') }}
                    </div>
                    <div class="flex space-x-2">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Order Details Modal -->
    <div id="orderDetailsModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('Order Details') }} #<span id="modalOrderId"></span>
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeModal()">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="mt-4" id="orderDetailsContent">
                    <!-- Order details will be loaded here -->
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end pt-4 border-t mt-4">
                    <button type="button"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200"
                        onclick="closeModal()">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // View Details Modal
                document.querySelectorAll('.view-details-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const orderId = button.dataset.orderId;
                        showOrderDetails(orderId);
                    });
                });

                // Confirm Order
                document.querySelectorAll('.confirm-order-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        if (confirm('{{ __('Are you sure you want to confirm this order?') }}')) {
                            const url = button.dataset.confirmUrl;
                            updateOrderStatus(url, 'confirmed');
                        }
                    });
                });

                // Cancel Order
                document.querySelectorAll('.cancel-order-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        if (confirm('{{ __('Are you sure you want to cancel this order?') }}')) {
                            const url = button.dataset.cancelUrl;
                            updateOrderStatus(url, 'cancelled');
                        }
                    });
                });
            });

            function showOrderDetails(orderId) {
                document.getElementById('modalOrderId').textContent = orderId;
                document.getElementById('orderDetailsContent').innerHTML =
                    '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i></div>';
                document.getElementById('orderDetailsModal').classList.remove('hidden');

                // Fetch order details
                const url = "{{ route('orders.show', ['order' => '__ID__']) }}"
                    .replace('__ID__', orderId);
                fetch(url, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayOrderDetails(data.order);
                        } else {
                            document.getElementById('orderDetailsContent').innerHTML =
                                '<div class="text-center py-4 text-red-500">{{ __('Error loading order details') }}</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('orderDetailsContent').innerHTML =
                            '<div class="text-center py-4 text-red-500">{{ __('Error loading order details') }}</div>';
                    });
            }

            function displayOrderDetails(order) {
                let detailsHtml = `
                    <div class="space-y-4">
                        <!-- Order Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('Order Information') }}</h4>
                                <p><strong>{{ __('Customer') }}:</strong> ${order.user.name}</p>
                                <p><strong>{{ __('Email') }}:</strong> ${order.user.email}</p>
                                <p><strong>{{ __('Phone') }}:</strong> ${order.user.phone}</p>
                                <p><strong>{{ __('Order Date') }}:</strong> ${new Date(order.order_date).toLocaleDateString('vi-VN')}</p>
                                <p><strong>{{ __('Status') }}:</strong> 
                                    <span class="px-2 py-1 text-xs rounded-full ${getStatusClass(order.status)}">
                                        ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('Shipping Information') }}</h4>
                                <p><strong>{{ __('Address') }}:</strong></p>
                                <p class="text-sm text-gray-600">${order.shipping_address}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">{{ __('Order Items') }}</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full border border-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Book') }}</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Quantity') }}</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Unit Price') }}</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                `;

                order.order_details.forEach(detail => {
                    detailsHtml += `
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-900">${detail.book.name}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">${detail.quantity}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">${formatCurrency(detail.unit_price)}</td>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">${formatCurrency(detail.subtotal)}</td>
                        </tr>
                    `;
                });

                detailsHtml += `
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Order Total -->
                        <div class="border-t pt-4">
                            <div class="flex justify-end">
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ __('Total Amount') }}: ${formatCurrency(order.total_amount)}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                document.getElementById('orderDetailsContent').innerHTML = detailsHtml;
            }

            function updateOrderStatus(url, action) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message || '{{ __('Error occurred') }}');
                        }
                    })
                    .catch(error => {
                        alert('{{ __('Unknown error occurred') }}');
                        console.error(error);
                    });
            }

            function closeModal() {
                document.getElementById('orderDetailsModal').classList.add('hidden');
            }

            function getStatusClass(status) {
                const classes = {
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'processing': 'bg-blue-100 text-blue-800',
                    'shipped': 'bg-purple-100 text-purple-800',
                    'delivered': 'bg-green-100 text-green-800',
                    'cancelled': 'bg-red-100 text-red-800'
                };
                return classes[status] || 'bg-gray-100 text-gray-800';
            }

            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }

            // Close modal when clicking outside
            document.getElementById('orderDetailsModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        </script>
    @endpush
</x-app-layout>
