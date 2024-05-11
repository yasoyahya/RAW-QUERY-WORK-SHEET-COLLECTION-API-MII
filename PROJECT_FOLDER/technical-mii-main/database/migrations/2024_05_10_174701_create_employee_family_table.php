<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_family', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('name', 255)->nullable();
            $table->string('identifier', 255)->nullable();
            $table->string('job', 255)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('religion', ['Islam', 'Katolik', 'Buda', 'Protestan', 'Konghucu']);
            $table->string('is_life');
            $table->string('is_divorced');
            $table->enum('relation_status', ['Suami', 'Istri', 'Anak', 'Anak Sambung']);
            $table->string('created_by', 255)->nullable();
            $table->string('updated_by', 255)->nullable();

            $table->timestamps();

            // Definisikan foreign key ke tabel employees
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_family');
    }
};
