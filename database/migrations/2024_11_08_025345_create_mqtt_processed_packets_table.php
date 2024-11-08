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
        Schema::create('mqtt_processed_packets', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->timestamp('timestamp');
            $table->unsignedSmallInteger('packet_id');
            $table->unsignedTinyInteger('packet_type');
            $table->unsignedInteger('packet_length');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mqtt_processed_packets');
    }
};
