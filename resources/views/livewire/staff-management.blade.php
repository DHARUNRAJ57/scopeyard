

<div class="container mx-auto py-6">
    <div class="overflow-x-auto">
        <div class="pb-4">
            <h1 class="text-2xl font-semibold">Staff Management</h1>
            <button wire:click="create()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Staff
            </button>
            @if (session()->has('message'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
        </div>
        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Employment Type</th>
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Joining Date</th>
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th class="py-2 px-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($staffs as $staff)
                        <tr>
                            <td class="py-3 px-3">{{ $staff->name }}</td>
                            <td class="py-3 px-3">{{ $staff->gender }}</td>
                            <td class="py-3 px-3">{{ $staff->employment_type }}</td>
                            <td class="py-3 px-3">{{ $staff->joining_date }}</td>
                            <td class="py-3 px-3">
                                @if ($staff->photo)
                                    <img src="{{ Storage::url($staff->photo) }}" alt="{{ $staff->name }}" class="h-8 w-8 rounded-full">
                                @else
                                    <span class="inline-block h-8 w-8 rounded-full bg-gray-300"></span>
                                @endif
                            </td>
                            <td class="py-3 px-3">
                                <button wire:click="edit({{ $staff->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $staff->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if ($isOpen)
        @include('livewire.create-staff')
    @endif
</div>
