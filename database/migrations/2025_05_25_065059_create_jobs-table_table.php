<?php

use App\Models\Company;
use App\Models\Job;
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
        //
        Schema::create((new Job)->getTable(), function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(Company::class);
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->unsignedBigInteger('salary');
            $table->enum('experience', Job::$experiences);
            $table->enum('category', Job::$categories);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( (new Job)->getTable());
    }
};
