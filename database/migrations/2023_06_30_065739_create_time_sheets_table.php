<?php

use App\Models\Job;
use App\Models\User;
use App\Models\Shift;
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
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Job::class);
            $table->foreignIdFor(Shift::class);
            $table->string('start_time');
            $table->string('end_time');
            $table->time('start_break')->nullable();
            $table->time('end_break')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_sheets');
    }
};
