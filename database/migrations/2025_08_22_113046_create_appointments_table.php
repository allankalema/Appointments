<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();

        // patient who made the appointment
        $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

        // doctor being booked
        $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');

        $table->text('details')->nullable();

        // when the appointment was created
        $table->timestamp('appointment_date');

        // status of whether it has been worked on
        $table->boolean('worked_on')->default(false);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
