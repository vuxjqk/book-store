<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-table>
                        <x-thead>
                            <x-tr>
                                <x-th>{{ __('term') }}</x-th>
                                <x-th>{{ __('description') }}</x-th>
                            </x-tr>
                        </x-thead>
                        <x-tbody>
                            <x-tr>
                                <x-th>{{ __('id') }}</x-th>
                                <x-td>{{ $category->id }}</x-td>
                            </x-tr>
                            <x-tr>
                                <x-th>{{ __('name') }}</x-th>
                                <x-td>{{ $category->name }}</x-td>
                            </x-tr>
                            <x-tr>
                                <x-th>{{ __('slug') }}</x-th>
                                <x-td>{{ $category->slug }}</x-td>
                            </x-tr>
                            <x-tr>
                                <x-th>{{ __('description') }}</x-th>
                                <x-td>{{ $category->description }}</x-td>
                            </x-tr>
                            <x-tr>
                                <x-th>{{ __('created at') }}</x-th>
                                <x-td>{{ $category->created_at }}</x-td>
                            </x-tr>
                            <x-tr>
                                <x-th>{{ __('updated at') }}</x-th>
                                <x-td>{{ $category->updated_at }}</x-td>
                            </x-tr>
                        </x-tbody>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
