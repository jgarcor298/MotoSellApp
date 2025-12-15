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
        Schema::create('motos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idmodelo');
            $table->integer('year');
            $table->string('cilindrada', 30);
            $table->foreignId('idtipo');
            $table->string('descripcion', 100);
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 100)->unique()->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->foreign('idmodelo')->references('id')->on('modelos');
            $table->foreign('idtipo')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos');
    }
};
