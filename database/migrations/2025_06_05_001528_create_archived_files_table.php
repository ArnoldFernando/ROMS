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
        Schema::create('archived_files', function (Blueprint $table) {
            $table->id();
            $table->string('document_code')->nullable();
            $table->string('subject')->nullable();
            $table->string('originating_office')->nullable();
            $table->string('remarks')->nullable();
            $table->string('file')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('folder_id')->nullable()->constrained('folders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_files');
    }
};
