<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUsersFields extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('users', 'is_visible')) {
            Schema::table('users', function ($table) {
                $table->boolean('is_visible')->default(false);
                $table->text('insider_description')->nullable();
                $table->text('position')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'is_visible')) {
            Schema::table('users', function ($table) {
                $table->dropColumn('is_visible');
                $table->dropColumn('insider_description');
                $table->dropColumn('position');
            });
        }
    }
}
