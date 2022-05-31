<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->timestamps();
        });

        Schema::create('matter_tag', function (Blueprint $table) {
            $table->id();

            $table->foreignId('matter_id');
            $table->foreignId('tag_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matter_tag');
        Schema::dropIfExists('tags');
    }
};
