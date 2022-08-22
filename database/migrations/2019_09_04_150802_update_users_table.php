<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('language_id')->nullable();
            $table->integer('type')->default(0)->nullable();
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 0: Female')->nullable();
            $table->string('mobile')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('id_number')->nullable();
            $table->string('facebook_id')->nullable();

            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('address')->nullable();

            $table->text('others')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(2)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title');
            $table->string('locale', 2)->nullable();
            $table->string('code', 5)->nullable();
            $table->tinyInteger('default')->default(0)->comment('1: Yes, 0: No')->nullable();
            $table->string('flag')->nullable();
            $table->tinyInteger('ordering')->default(1)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
            $table->timestamps();
        });

        Schema::create('languages_refer', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('item_type', '20')->nullable();
            $table->integer('item_id')->nullable();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('permission')->nullable();
            $table->tinyInteger('default')->default(0)->comment('1: Yes, 0: No')->nullable();
            $table->tinyInteger('ordering')->default(1)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type', '20')->nullable();
            $table->string('key');
            $table->text('value')->nullable();
            $table->tinyInteger('auto_load')->default(0)->comment('1: Yes, 0: No')->nullable();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->string('mine_type')->nullable();
            $table->string('size')->nullable();
            $table->string('url')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
            $table->timestamps();
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->text('type_changes')->nullable();
            $table->string('action')->nullable();
            $table->text('body')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip_address', 25)->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            //
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->integer('language_id')->nullable();
            $table->integer('role_id')->default(0)->nullable();
            $table->text('permission')->nullable();
            $table->string('ga_code')->comment('Google Authenticator Code')->nullable();

            $table->string('mobile')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 0: Female')->nullable();

            $table->text('others')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'language_id',
                'type',
                'gender',
                'mobile',
                'address',
                'avatar',
                'birthday',
                'id_number',
                'province_id',
                'district_id',
                'ward_id',
                'address',
                'others',
                'created_by',
                'updated_by',
                'status',
            ]);
        });

        Schema::dropIfExists('languages');
        Schema::dropIfExists('languages_refer');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('media');
        Schema::dropIfExists('audits');
        Schema::dropIfExists('admins');
    }
}
