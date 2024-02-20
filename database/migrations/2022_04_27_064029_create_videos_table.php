<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('episode');
            $table->boolean('intro')->default(0);
            $table->time('duration');
            $table->string('video_code');
            $table->string('video_url'); // رابط الفيديو الذي تم إضافته بعد التعديل
            $table->string('pdf_file')->nullable();
            $table->string('web_link')->nullable(); // New web_link field
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
