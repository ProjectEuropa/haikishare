<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('store');
          $table->string('address');
          $table->integer('zip');
          $table->string('email', '191');
          $table->timestamp('email_verified_at');
          $table->string('password');
          $table->rememberToken();
          $table->boolean('delete_flg')->default('0');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies', function (Blueprint $table) {
            //
        });
    }
}
