<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrdersTableMakeAddressLineNullable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address_line_1')->nullable()->change();
            // Add other columns that need to be nullable here
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address_line_1')->change();
            // Add other columns that need to be reverted here
        });
    }
}
