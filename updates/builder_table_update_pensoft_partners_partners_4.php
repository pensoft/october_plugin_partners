<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->integer('parent_id')->default(null)->change();
            $table->integer('nest_left')->default(null)->change();
            $table->integer('nest_right')->default(null)->change();
            $table->integer('nest_depth')->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->integer('parent_id')->default(1)->change();
            $table->integer('nest_left')->default(1)->change();
            $table->integer('nest_right')->default(1)->change();
            $table->integer('nest_depth')->default(1)->change();
        });
    }
}
