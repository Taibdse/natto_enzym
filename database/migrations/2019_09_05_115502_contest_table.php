<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contest', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('category_id')->default(0)->nullable();
            $table->integer('round')->default(1)->nullable();
            $table->integer('language_id')->nullable();

            $table->string('image')->nullable();
            $table->string('image_full')->nullable();
            $table->string('image_share')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->integer('votes')->nullable();
            $table->integer('shares')->nullable();

            $table->integer('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_mobile')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_id_number')->nullable();
            $table->string('user_avatar')->nullable();
            $table->string('utm_campaign', 20)->nullable();
            $table->string('utm_source', 20)->nullable();
            $table->string('utm_medium', 20)->nullable();

            $table->tinyInteger('featured')->default(0)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('contest_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->default(0)->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();

            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('contest_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->default(1)->comment('1: Vote, 2: Share')->nullable();
            $table->integer('contest_id')->default(0)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address', 25)->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        //
        Schema::dropIfExists('contest');
        Schema::dropIfExists('contest_category');
        Schema::dropIfExists('contest_log');
    }
}
