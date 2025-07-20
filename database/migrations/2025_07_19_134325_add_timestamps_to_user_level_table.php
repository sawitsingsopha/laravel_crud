<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_level', function (Blueprint $table) {
            $table->timestamps(); // เพิ่ม created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::table('user_level', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
