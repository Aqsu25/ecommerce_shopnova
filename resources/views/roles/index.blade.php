<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between text-white">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded border text-decoration-none  text-white rounded-md">Create</a>

        </div>
    </x-slot>
    <div class="min-h-screen bg-purple-25  p-6">
        <div class="bg-white shadow-md rounded-xl w-full max-w-6xl overflow-auto">
            <table class="w-full  table-auto min-w-max">
                <thead>
                    <tr class="bg-blue-gray-50 border-b border-blue-gray-100">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left">Permission</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-b border-blue-gray-50">
                            <td class="px-6 py-3 text-left">{{ $role->id }}</td>
                            <td class="px-6 py-3 text-left">{{ $role->name }}</td>
                            <td class="px-6 py-3 text-left">
                                {{ $role->permissions->pluck('name')->implode(', ') }}</td>
                            <td class="px-6 py-3 flex justify-center gap-2">
                                <a href="{{ route('roles.edit', $role->id) }}"
                                    class="bg-blue-700 text-white px-3 py-2 rounded-md hover:bg-blue-600 text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-700 text-white px-3 py-2 rounded-md hover:bg-red-600 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
