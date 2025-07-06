<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToDosensTable extends Migration
{
    public function up()
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('email')->unique()->nullable()->after('nuptk');
        });
    }

    public function down()
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}