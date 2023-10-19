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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description'); 
            $table->string('image')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->unsignedBigInteger('category_id'); // Foreign key for category
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->timestamps(); 

            // Define foreign key constraints
            // category_id
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // user_id 
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
