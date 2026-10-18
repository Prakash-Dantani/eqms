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
        Schema::create('documents', function (Blueprint $table) {

            $table->id();

            $table->string('document_no')->unique();

            $table->string('title');

            $table->string('document_type');

            $table->string('category');

            $table->string('department')->nullable();

            $table->string('owner')->nullable();

            $table->string('version')->default('1.0');

            $table->date('effective_date')->nullable();

            $table->date('review_date')->nullable();

            $table->date('expiry_date')->nullable();

            $table->longText('description')->nullable();

            $table->string('attachment')->nullable();

            $table->enum('status', [
                'Draft',
                'Pending Review',
                'Pending Approval',
                'Approved',
                'Rejected',
                'Obsolete',
            ])->default('Draft');

            $table->timestamps();

        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
