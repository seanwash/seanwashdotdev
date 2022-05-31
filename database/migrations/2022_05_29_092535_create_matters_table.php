<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('external_url')->nullable();
            $table->longText('content')->nullable();
            $table->string('type')->index();
            $table->timestamp('public_at')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matters');
    }
};
