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
        Schema::create('submitters', function (Blueprint $table) {
            $table->id();
            
            $table->string('email')
            ->unique();

            $table->string('display_name');
            
            $table->string('real_name');
            
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
        Schema::table('guestbook_entries', function (Blueprint $table) {
            $table->dropColumn('submitter_id');
        });

        Schema::dropIfExists('submitters');
    }
};
