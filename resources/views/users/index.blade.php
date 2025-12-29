
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between text-black">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Users') }}
            </h2>
        </div>

    </x-slot>
    <div class="min-h-screen   p-6">
        <div class="bg-white shadow-md rounded-xl w-full max-w-6xl overflow-auto">
            <table class="w-full text-left min-w-max mt-5">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal
                                 leading-none text-blue-gray-900 opacity-70">
                                #
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Name
                            </p>
                        </th>
                        <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Email
                            </p>
                        </th>
                        {{-- <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Role
                            </p>
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @can('view', $user)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $user->id }}
                                    </p>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $user->name }}
                                    </p>
                                </td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $user->email }}
                                    </p>
                                </td>
                               
                            </tr>
                        @endcan
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


