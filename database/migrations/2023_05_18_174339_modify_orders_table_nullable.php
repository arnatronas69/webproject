<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrdersTableNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('company_name')->nullable()->change();
            $table->string('address_line_2')->nullable()->change();
            $table->string('town_city')->nullable()->change();
            $table->string('state')->nullable()->change();
            // Add other columns here if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name')->change();
            $table->string('last_name')->change();
            $table->string('email')->change();
            $table->string('phone_number')->change();
            $table->string('company_name')->change();
            $table->string('address_line_2')->change();
            $table->string('town_city')->change();
            $table->string('state')->change();
            // Add other columns here if needed
        });
    }
}
