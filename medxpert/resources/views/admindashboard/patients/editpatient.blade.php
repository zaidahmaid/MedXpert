@extends('admindashboard.layout')

@section('title' , 'Add Patient')

@section('contant')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Patient Information</h3>
                </div>
                
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $patient->user->id }}">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Personal Information</h4>
                                <hr>
                                
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $patient->user->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $patient->user->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" name="age" id="age" class="form-control @error('age') is-invalid @enderror" 
                                           value="{{ old('age', $patient->age) }}" required>
                                    @error('age')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h4>Medical History</h4>
                                <hr>
                                
                                <div class="form-group">
                                    <label for="chronic_diseases">Chronic Diseases</label>
                                    <textarea name="chronic_diseases" id="chronic_diseases" rows="3" 
                                              class="form-control @error('chronic_diseases') is-invalid @enderror">{{ old('chronic_diseases', $patient->medicalHistory->chronic_diseases ?? '') }}</textarea>
                                    @error('chronic_diseases')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="medications">Medications</label>
                                    <textarea name="medications" id="medications" rows="3" 
                                              class="form-control @error('medications') is-invalid @enderror">{{ old('medications', $patient->medicalHistory->medications ?? '') }}</textarea>
                                    @error('medications')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="allergies">Allergies</label>
                                    <textarea name="allergies" id="allergies" rows="3" 
                                              class="form-control @error('allergies') is-invalid @enderror">{{ old('allergies', $patient->medicalHistory->allergies ?? '') }}</textarea>
                                    @error('allergies')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" 
                                              class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $patient->medicalHistory->notes ?? '') }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Patient Information</button>
                            <a href="{{ route('pat') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif

@endsection