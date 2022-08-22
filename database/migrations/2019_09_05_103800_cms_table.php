<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cms_attribute', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->comment('1: text, 2: textarea, 3: editor, 4: ...')->nullable();

            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_attribute_options', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('attribute_id')->nullable();
            $table->string('title')->nullable();
            $table->string('value')->nullable();
            $table->integer('ordering')->default(1)->nullable();
        });

        Schema::create('cms_attribute_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('attribute_id')->nullable();
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->text('value')->nullable();
        });

        Schema::create('cms_attribute_category', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('attribute_id')->nullable();
            $table->integer('category_id')->nullable();
        });

        Schema::create('cms_categories', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->integer('attribute_id')->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->string('module', 20)->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->text('others')->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('featured')->default(0)->comment('1: Yes, 0: No')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_pages', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->text('gallery')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('featured')->default(0)->comment('1: Yes, 0: No')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_news', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->text('gallery')->nullable();
            $table->string('refer_link')->nullable();
            $table->date('refer_date')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('featured')->default(0)->comment('1: Yes, 0: No')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('publish_at')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_news_categories', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('news_id')->nullable();
            $table->integer('category_id')->nullable();
        });

        Schema::create('cms_tags', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_seo', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('cms_slugs', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->string('key')->nullable();
            $table->string('prefix')->nullable();
        });

        Schema::create('cms_contact', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->default(1)->comment('1: Male, 0: Female')->nullable();
            $table->string('address')->nullable();
            $table->string('company_job')->nullable();
            $table->string('company_name')->nullable();
            $table->text('comment')->nullable();
            $table->text('reply')->nullable();
            $table->tinyInteger('status')->default(2)->comment('0: Deleted, 1: Draft, 2: UnRead, 3: Read, 4: Reply')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_subscribe', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender')->default(1)->comment('1: Male, 0: Female')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module', 20)->nullable();
            $table->integer('module_item_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('rating')->default(1)->nullable();
            $table->integer('likes')->default(0)->nullable();
            $table->tinyInteger('status')->default(2)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_gallery', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('items')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_documents', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->string('link')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_banners', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_partners', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_projects', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('introtext')->nullable();
            $table->text('fulltext')->nullable();
            $table->text('gallery')->nullable();
            $table->integer('views')->default(1)->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_faq', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->text('quenstion')->nullable();
            $table->text('answer')->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_reviews', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('company')->nullable();
            $table->text('review')->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(3)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_menu_items', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('menu_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('link')->nullable();
            $table->string('target')->nullable();
            $table->integer('ordering')->default(1)->nullable();
            $table->tinyInteger('status')->default(4)->comment('0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('cms_member', function (Blueprint $table) {
            //
            $table->integer('language_id')->nullable();
            $table->integer('type')->default(0)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('mobile')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('id_number')->nullable();
            $table->tinyInteger('gender')->default(1)->comment('1: Male, 0: Female')->nullable();
            $table->integer('facebook_id')->nullable();

            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('address')->nullable();

            $table->text('others')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('status')->default(2)->comment('0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable')->nullable();
        });

        Schema::create('cms_admin_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('updated_by');
            $table->string('table_name');
            $table->string('field_name');
            $table->string('before')->nullable();
            $table->string('after')->nullable();
            $table->integer('item_id');
            $table->tinyInteger('type');   // 0: delete, 1: create, 2: edit
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
        Schema::dropIfExists('cms_attribute');
        Schema::dropIfExists('cms_attribute_options');
        Schema::dropIfExists('cms_attribute_value');
        Schema::dropIfExists('cms_attribute_category');
        Schema::dropIfExists('cms_categories');

        Schema::dropIfExists('cms_pages');
        Schema::dropIfExists('cms_news');
        Schema::dropIfExists('cms_news_categories');
        Schema::dropIfExists('cms_tags');
        Schema::dropIfExists('cms_seo');
        Schema::dropIfExists('cms_slugs');
        Schema::dropIfExists('cms_contact');
        Schema::dropIfExists('cms_subscribe');
        Schema::dropIfExists('cms_comments');
        Schema::dropIfExists('cms_gallery');
        Schema::dropIfExists('cms_documents');
        Schema::dropIfExists('cms_banners');
        Schema::dropIfExists('cms_partners');
        Schema::dropIfExists('cms_projects');
        Schema::dropIfExists('cms_faq');
        Schema::dropIfExists('cms_reviews');
        Schema::dropIfExists('cms_member');
        Schema::dropIfExists('cms_admin_log');
    }
}
