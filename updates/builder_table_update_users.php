<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUsers extends Migration
{
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                $table->integer('partner_id')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'partner_id')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('partner_id');
            });
        }
    }
}
