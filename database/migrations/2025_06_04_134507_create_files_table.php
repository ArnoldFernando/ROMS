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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('document_code')->nullable(); // Unique code for the document
            $table->string('subject')->nullable(); // Subject of the document
            $table->string('originating_office')->nullable(); // Title of the document
            $table->string('remarks')->nullable();
            $table->string('file')->nullable(); // File path or name
            $table->date('date')->nullable(); // e.g., 'image', 'document', etc.
            $table->foreignId('folder_id')->nullable()->constrained('folders')->onDelete('cascade'); // Foreign key to folders table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
