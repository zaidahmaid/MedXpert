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
                                <img src="{{ asset('storage/' . $doctor->doctorDetails->image) }}" alt="{{ $doctor->user->name }}" class="w-full rounded-lg object-cover">
                                
                                <div class="mt-4">
                                    <!-- Rating Stars -->
                                    <div class="flex items-center mt-2">
                                        <span class="text-gray-600 mr-2">Rating:</span>
                                        <div class="flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $doctor->doctorDetails->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            @endfor
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
                            <div class="mt-8">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
