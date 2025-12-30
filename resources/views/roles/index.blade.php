@extends('dashboard.dashboard')


@section('content')
    <div class="min-h-screen bg-purple-25  p-6">
        <a href="{{ route('roles.create') }}"
            class="bg-blue-700 text-white px-3 text-end py-2 font-bond my-3 fs-4 rounded-md hover:bg-blue-600 text-sm text-decoration-none">
            Create
        </a>
        <div class="bg-white shadow-md rounded-xl w-full max-w-6xl overflow-auto my-3">
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
@endsection
