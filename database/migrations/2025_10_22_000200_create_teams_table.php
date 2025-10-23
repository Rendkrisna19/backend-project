<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // nama tim
            $table->string('member_name');  // nama anggota
            $table->string('role')->nullable(); // front-end/back-end/QA
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('teams');
    }
};
