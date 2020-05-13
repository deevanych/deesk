<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuePrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('issue_priorities');
    }
}
