<div class="grid grid-cols-1">
    <div class="overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Student Documents</h2>
            <button data-modal-target="add-student-document-modal" data-modal-toggle="add-student-document-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            File Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-md font-medium text-gray-500 uppercase tracking-wider">
                            File Type
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-md font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($model->attachments as $attachment)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-md font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-500">
                                {{ $attachment->file_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $attachment->file_type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-md font-medium">
                                @can('view-student-attachment')
                                    <a href="{{ route('showStudentAttachment', ['attachment' => $attachment]) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-4">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('download-student-attachment')
                                    <a href="{{ route('showStudentAttachment', ['attachment' => $attachment]) }}"
                                        class="text-green-600 hover:text-green-900 mr-4" download>
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endcan
                                @can('delete-student-attachment')
                                    <form action="{{ route('deleteStudentAttachment', ['student' => $model, 'attachment' => $attachment]) }}"
                                        style="display: inline-block" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900 delete-btn">
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
</div>


{{-- Add Student Section Modal --}}
<div id="add-student-document-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <form action="{{ route('storeStudentAttachment', ['student' => $model]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center justify-between p-4 md:p-5  rounded-t  border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Student Document
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-student-document-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-1">
                        <input type="hidden" name="student_id" value="{{ $model->id }}">
                        <div class="mb-4">
                            <label for="attachments" class="block mb-3 text-sm font-medium text-gray-700">File</label>
                            <input type="file" name="attachments[]" multiple required class="w-full px-4 py-2 border border-gray-300 rounded-md transition duration-150" />
                            @error('attachments')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 rounded-b ">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    <button data-modal-hide="add-student-section-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none bg-red-600 rounded-lg border border-gray-200 hover:bg-red-700 text-white">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End of Add Student Section Modal --}}
