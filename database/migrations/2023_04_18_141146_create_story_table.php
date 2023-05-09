<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story', function (Blueprint $table) {
            $table->id();
            $table->string("domain");
            $table->string("img")->nullable();
            $table->string("title");
            $table->string("language");
            $table->string("public")->default(true);
            $table->string("onlyUser")->default(false);
            $table->string("note")->nullable();
            $table->string("annotation")->nullable();
            $table->string("height")->nullable();
            $table->string("have")->nullable();
            $table->string("file")->nullable();
            $table->string("attribute")->nullable();
            $table->string("labels")->nullable();
            $table->string("prop-text")->nullable();
            $table->string("collection")->nullable();
            $table->string("publisher")->nullable();
            $table->string("editor")->nullable();
            $table->string("translator")->nullable();
            $table->string("maker")->nullable();
            $table->string("year")->nullable();
            $table->string("lenght")->nullable();
            $table->string("art_author")->nullable();
            $table->string("template_author")->nullable();
            $table->string("text_author")->nullable();
            $table->string("marked")->nullable();
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
        Schema::dropIfExists('story');
    }
};
