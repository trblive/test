<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('salary', 45);
            $table->string('tags');
            $table->string('company');
            $table->string('address');
            $table->string('city', 45);
            $table->string('state', 45);
            $table->string('phone', 45);
            $table->string('email');
            $table->text('requirements');
            $table->text('benefits');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
