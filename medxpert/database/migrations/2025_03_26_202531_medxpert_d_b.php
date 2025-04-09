<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'doctor', 'patient'])->default('patient')->nullable();
            $table->timestamps();
        });

        // Admins Table
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Doctors Table
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Doctor Details Table
        Schema::create('doctor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->unique()->constrained('doctors')->onDelete('cascade');
            $table->string('specialty');
            $table->text('clinic_address');
            $table->string('city', 100);
            $table->decimal('price', 10, 2);
            $table->string('phone', 10);
            $table->integer('experience_years');
            $table->string('image')->nullable();
            $table->enum('rating', ['1', '2', '3', '4', '5'])->default('4');
            $table->timestamps();
        });

        // Patients Table
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->integer('age');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->timestamps();
        });

        // Patient Medical History Table
        Schema::create('patient_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->unique()->constrained('patients')->onDelete('cascade');
            $table->string('chronic_diseases')->nullable()->default('None');
            $table->string('medications')->nullable()->default('None');
            $table->string('allergies')->nullable()->default('None');
            $table->string('notes')->nullable()->default('No additional notes');
            $table->timestamps();
        });
        

        // Available Slots Table
        Schema::create('available_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_booked')->default(false);
            $table->timestamps();
        });

        // Appointments Table
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('slot_id')->unique()->constrained('available_slots')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'expired'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // form table
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message')->nullable();
            $table->boolean('replied')->default(false);
            $table->timestamps();
        });
        


    }


    public function down()
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('available_slots');
        Schema::dropIfExists('patient_medical_history');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('doctor_details');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
        Schema::dropIfExists('forms');
    }
};
