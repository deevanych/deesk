<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('activity_type')->unsigned()->nullable();
            $table->bigInteger('issue_id')->unsigned()->nullable();
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->bigInteger('comment_id')->unsigned()->nullable();
            $table->foreign('comment_id')->references('id')->on('issues');
            $table->bigInteger('issue_status_id')->unsigned()->nullable();
            $table->foreign('issue_status_id')->references('id')->on('issue_statuses');
            $table->bigInteger('issue_priority_id')->unsigned()->nullable();
            $table->foreign('issue_priority_id')->references('id')->on('issue_priorities');
            $table->bigInteger('issue_type_id')->unsigned()->nullable();
            $table->foreign('issue_type_id')->references('id')->on('issue_types');
            $table->bigInteger('service_organization_id')->unsigned();
            $table->foreign('service_organization_id')->references('id')->on('organizations');
            $table->bigInteger('client_organization_id')->unsigned();
            $table->foreign('client_organization_id')->references('id')->on('organizations');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->integer('type')->unsigned();
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
        Schema::dropIfExists('activities');
    }
}
