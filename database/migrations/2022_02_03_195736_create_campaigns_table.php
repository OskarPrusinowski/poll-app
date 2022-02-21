<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('comunication_type')->nullable();
            $table->date('date_registration')->nullable();
            $table->string('file_name')->nullable();
            $table->string('orginal_file_name')->nullable();
            $table->boolean('is_contact_list')->default(false);
            $table->boolean('is_anonymizated')->default(false);
            $table->date('date_published')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('company_id')->nullable()->unsigned();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
