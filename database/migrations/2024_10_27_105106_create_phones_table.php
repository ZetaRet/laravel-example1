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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('phone_type');
            $table->string('phone_ext');
            $table->string('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('phones', function (Blueprint $table) {
            //
        });
    }
};

?>