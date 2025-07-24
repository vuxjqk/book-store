<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book') }}
            </h2>
            <x-create-button href="{{ route('books.create') }}" text="Thêm sách" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        </div>
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
        </script>
    @endpush
</x-app-layout>
