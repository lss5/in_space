<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('active_at')->nullable();

            $table->foreignId('artist_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->string('name');
            $table->string('link');
            $table->string('extension');
            $table->text('description')->nullable();
            $table->string('status', 36)->default('created');
            $table->string('content_type', 36);
            $table->string('publicity', 36);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
