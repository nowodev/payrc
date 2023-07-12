<?php

use App\Models\Job;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class);
            $table->string('shift_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('has_break');
            $table->string('break_type')->nullable();
            $table->string('break_duration')->nullable();
            $table->string('total_hours');
            $table->string('expected_earnings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
