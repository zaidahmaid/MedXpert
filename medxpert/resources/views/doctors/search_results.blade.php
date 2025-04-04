@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold mb-6">Search Results</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($doctors as $doctor)
                <div class="doctor-card p-6 bg-white rounded-lg shadow-md">
                    <h3 class="font-semibold text-xl mb-2">{{ $doctor->user->name }}</h3>
                    <p class="text-gray-600">{{ $doctor->doctorDetails->specialty }}</p>
                    <p class="text-gray-500">{{ $doctor->doctorDetails->city }}</p>
                    <p class="text-blue-600">Price: ${{ $doctor->doctorDetails->price }}</p>
                    <a href="{{ route('doctor.profile', $doctor->id) }}" class="text-blue-600 hover:underline">View Profile</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
