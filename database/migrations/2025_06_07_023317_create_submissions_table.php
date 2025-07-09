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
            $table->bigInteger('user_id')->index();
            $table->bigInteger('category_id')->index();
            $table->text('image_path');
            $table->string('ticket_number')->nullable();
            $table->string('title');
            $table->text('description');
            $table->date('estimated_date')->nullable();
            $table->text('survey')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('available', ['public', 'private'])->default('private');
            $table->timestamps();
            $table->softDeletes();
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
