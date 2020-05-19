<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdAndCompanyIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
          $table->unsignedBigInteger('category_id');
          $table->foreign('category_id')->references('id')->on('categories');
          $table->unsignedBigInteger('company_id');
          $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
          $table->dropForeign(['category_id']);
          $table->dropColumn('category_id');
          $table->dropForeign(['company_id']);
          $table->dropColumn('company_id');
        });
    }
}
