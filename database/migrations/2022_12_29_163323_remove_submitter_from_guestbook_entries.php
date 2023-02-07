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
        Schema::table('guestbook_entries', function (Blueprint $table) {
            $table->dropColumn('submitter_email');
            $table->dropColumn('submitter_display_name');
            $table->dropColumn('submitter_real_name');

            $table->foreignId('submitter_id')
                ->after('id')
                ->unsigned()
                ->nullable()
                ->constrained('submitters')
                ->change();
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
            $table->after('content', function ($table) {
                $table->string('submitter_email')
                    ->nullable();

                $table->string('submitter_display_name')
                    ->nullable();

                $table->string('submitter_real_name')
                    ->nullable();
            });
        });
    }
};
