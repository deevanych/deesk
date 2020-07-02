<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('issue_type_id')->unsigned()->nullable();
            $table->foreign('issue_type_id')->references('id')->on('issue_types');
            $table->bigInteger('issue_status_id')->unsigned()->nullable();
            $table->foreign('issue_status_id')->references('id')->on('issue_statuses');
            $table->bigInteger('issue_priority_id')->unsigned()->nullable();
            $table->foreign('issue_priority_id')->references('id')->on('issue_priorities');
            $table->bigInteger('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->bigInteger('author_organization_id')->unsigned();
            $table->foreign('author_organization_id')->references('id')->on('organizations');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users');
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users');
            $table->bigInteger('registration_type_id')->unsigned();
            $table->foreign('registration_type_id')->references('id')->on('registration_types');
            $table->string('title');
            $table->mediumText('description');
            $table->timestamp('planned_at')->nullable();
            $table->timestamp('reaction_time')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
