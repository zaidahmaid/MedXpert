@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <div class="flex flex-col md:flex-row">
                    <!-- Doctor Image -->
                    <div class="md:w-1/3 mb-6 md:mb-0">
                        <div class="bg-gray-100 p-6 rounded-lg shadow">
                            <img src="{{ asset($doctor->doctorDetails->image) }}" alt="{{ $doctor->user->name }}" class="w-full rounded-lg object-cover">

                            <div class="mt-4">
                                <!-- Rating Stars -->
                                <div class="flex items-center mt-2">
                                    <span class="text-gray-600 mr-2">Rating:</span>
                                    <div class="flex">
                                        <?php
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($i < $doctor->doctorDetails['rating']) {
                                                echo "<i class='fas fa-star text-primary'></i>";
                                            } else {
                                                echo "<i class='far fa-star text-primary'></i>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Consultation Price -->
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl font-semibold text-blue-600">${{ $doctor->doctorDetails->price }}</span>
                                    <span class="text-gray-600 text-sm"> per consultation</span>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Doctor Details -->
                    <div class="md:w-2/3 md:pl-8">
                        <h1 class="text-3xl font-bold text-gray-800">Dr. {{ $doctor->user->name }}</h1>
                        <h2 class="text-xl text-blue-600 mt-1">{{ $doctor->doctorDetails->specialty }}</h2>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Experience -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <!-- Clock Icon Inline SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-600">Experience</span>
                                </div>
                                <div class="mt-2 text-lg font-medium">
                                    {{ $doctor->doctorDetails->experience_years }} years
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-gray-600">City</span>
                                </div>
                                <div class="mt-2 text-lg font-medium">
                                    {{ $doctor->doctorDetails->city }}
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-gray-600">Phone</span>
                                </div>
                                <div class="mt-2 text-lg font-medium">
                                    {{ $doctor->doctorDetails->phone }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="border p-4 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-600">Email</span>
                                </div>
                                <div class="mt-2 text-lg font-medium">
                                    {{ $doctor->user->email }}
                                </div>
                            </div>

                        </div>

                        <!-- Clinic Address -->
                        <div class="mt-6 border p-4 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-gray-600">Clinic Address</span>
                            </div>
                            <div class="mt-2 text-lg">
                                {{ $doctor->doctorDetails->clinic_address }}
                            </div>
                        </div>

                        <!-- Available Slots Section -->
                        <div class="bg-white rounded-lg shadow-md mb-6">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-blue-600">Available Slots</h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @if(isset($avaslot) && count($avaslot) > 0)
                                                @foreach($avaslot as $slot)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 text-sm text-gray-700">{{ $slot->date }}</td>
                                                    <td class="py-3 px-4 text-sm text-gray-700">{{ $slot->start_time }}</td>
                                                    <td class="py-3 px-4 text-sm text-gray-700">{{ $slot->end_time }}</td>
                                                    <td class="py-3 px-4 text-sm">
                                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $slot->is_booked ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                            {{ $slot->is_booked ? 'Booked' : 'Available' }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-4 text-sm">
                                                        <a href="{{ route('admin.slots.edit', $slot->id) }}" class="inline-flex items-center px-3 py-1 border border-blue-600 text-blue-600 rounded-md text-sm hover:bg-blue-50 mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-1 border border-red-600 text-red-600 rounded-md text-sm hover:bg-red-50"
                                                            onclick="confirmDeleteSlot('{{ $slot->id }}')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="5" class="py-8 px-4 text-center text-gray-500">No available slots found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="openSlotModalBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add New Slot
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal backdrop -->
                        <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity hidden"></div>

                        <!-- Add Slot Modal -->
                        <div id="addSlotModal" class="fixed inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                    Add New Available Slot
                                                </h3>
                                                <div class="mt-4">
                                                    <form id="addSlotForm" action="{{ route('admin.slots.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                                                        <div class="mb-4">
                                                            <label for="slot_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                                            <input type="date" name="date" id="slot_date" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required min="{{ date('Y-m-d') }}">
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                                                            <input type="time" name="start_time" id="start_time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                                                            <input type="time" name="end_time" id="end_time" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="is_booked" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                            <select name="is_booked" id="is_booked" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                                                <option value="0">Available</option>
                                                                <option value="1">Booked</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="button" id="submitSlotBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Add Slot
                                        </button>
                                        <button type="button" id="closeModalBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div id="deleteConfirmModal" class="fixed inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                    Delete Slot
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">
                                                        Are you sure you want to delete this slot? This action cannot be undone.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <form id="deleteSlotForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Delete
                                            </button>
                                        </form>
                                        <button type="button" id="cancelDeleteBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete User Form (hidden) -->
                        <form id="delete-user-form" action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <!-- <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Available Slots</h3>
                            <div class="overflow-x-auto">
                                @if($availableSlots->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($availableSlots as $slot)
                                    <div class="border rounded-lg p-3 bg-gray-50">
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($slot->date)->format('D, M d, Y') }}</div>
                                        <div class="text-gray-600">{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</div>

                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="text-gray-600">No available slots for this doctor.</div>
                                @endif
                            </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
<script>
    // Modal functionality
    const modalBackdrop = document.getElementById('modal-backdrop');
    const addSlotModal = document.getElementById('addSlotModal');
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    const openSlotModalBtn = document.getElementById('openSlotModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const submitSlotBtn = document.getElementById('submitSlotBtn');
    const addSlotForm = document.getElementById('addSlotForm');
    const deleteSlotForm = document.getElementById('deleteSlotForm');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    // Open Add Slot Modal
    openSlotModalBtn.addEventListener('click', () => {
        modalBackdrop.classList.remove('hidden');
        addSlotModal.classList.remove('hidden');
    });

    // Close Add Slot Modal
    closeModalBtn.addEventListener('click', () => {
        modalBackdrop.classList.add('hidden');
        addSlotModal.classList.add('hidden');
    });

    // Submit Add Slot Form
    submitSlotBtn.addEventListener('click', () => {
        if (addSlotForm.checkValidity()) {
            addSlotForm.submit();
        } else {
            addSlotForm.reportValidity();
        }
    });

    // Close Delete Confirm Modal
    cancelDeleteBtn.addEventListener('click', () => {
        modalBackdrop.classList.add('hidden');
        deleteConfirmModal.classList.add('hidden');
    });

    // Handle slot deletion
    function confirmDeleteSlot(slotId) {
        deleteSlotForm.action = `/admin/slots/${slotId}`;
        modalBackdrop.classList.remove('hidden');
        deleteConfirmModal.classList.remove('hidden');
    }

    // Close modals when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            modalBackdrop.classList.add('hidden');
            addSlotModal.classList.add('hidden');
            deleteConfirmModal.classList.add('hidden');
        }
    });

    // Form validation for time slots
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');

    endTimeInput.addEventListener('change', () => {
        if (startTimeInput.value && endTimeInput.value && startTimeInput.value >= endTimeInput.value) {
            alert('End time must be later than start time');
            endTimeInput.value = '';
        }
    });

    startTimeInput.addEventListener('change', () => {
        if (startTimeInput.value && endTimeInput.value && startTimeInput.value >= endTimeInput.value) {
            alert('Start time must be earlier than end time');
            startTimeInput.value = '';
        }
    });
</script>