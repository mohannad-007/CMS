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
        Schema::create('work_plan_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workPlan_id')->constrained('work_plans')->cascadeOnDelete();
            $table->json('title');
            $table->json('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_plan_infos');
    }
};
