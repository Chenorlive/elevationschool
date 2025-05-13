@extends('layouts.admin')
@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
            @can('add-user')
                <a href="{{ route('users.create') }}"
                    class="px-2 py-1 rounded-sm text-md bg-blue-600 text-white hover:bg-blue-700">
                    <i class="fas fa-plus-circle"></i>
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto p-5">
            <table class="min-w-full divide-y divide-gray-200 dataTable nowrap">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $user->photo) }}"
                                            alt="Photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-md font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-md leading-5 font-semibold rounded-full 
                                  {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-md font-medium">
                                @can('edit-user')
                                    <a href="{{ route('users.edit', ['user' => $user]) }}"
                                        class="text-yellow-600 hover:text-yellow-900 mr-4">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('view-user-details')
                                    <a href="{{ route('users.show', ['user' => $user]) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('delete-user')
                                    <form action="{{ route('users.destroy', ['user' => $user]) }}"
                                        style="display: inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 delete-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
