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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('notes')->nullable();
            $table->text('feedback')->nullable();
            $table->string('status');
            $table->string('points')->nullable();
            $table->string('submitter');
            $table->unsignedBigInteger('assignment_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->string('attachment');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
