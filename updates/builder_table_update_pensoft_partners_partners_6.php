<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners6 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->string('country_code', 255)->change();
        });
    }
    
    public function down()
    {

        // Schema::table('pensoft_partners_partners', function($table)
        // {
        //     $table->string('country_code', 2)->change();
        // });
    }
}
