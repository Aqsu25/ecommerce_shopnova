<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-black-800 leading-tight">
                {{ __('User / Edit') }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="bg-slate-700  border text-decoration-none text-sm text-white rounded-md px-3 py-2 hover:bg-slate-600">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="text-sm font-medium text-black">Name</label>
                            <div class="my-3">
                                <input type="text" value="{{ old('name', $user->name) }}" name="name"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="" class="text-sm font-medium text-black">Email</label>
                            <div class="my-3">
                                <input type="email" value="{{ old('email', $user->email) }}" name="email"
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                @error('email')
                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="" class="text-sm font-medium text-black">Role</label>
                            <div class="my-3">
                                <select name="role" id=""
                                    class="border-gray-300 text-black shadow-sm w-1/2 rounded-lg">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-slate-700 border text-sm text-white rounded-md px-3 py-2 mb-3 mt-5 hover:bg-slate-600">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
