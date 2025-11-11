<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners7 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->string('additional_url')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->dropColumn('additional_url');
        });
    }
}

