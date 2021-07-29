<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeletePensoftPartnersPartnersCountries extends Migration
{
    public function up()
    {
        Schema::dropIfExists('pensoft_partners_partners_countries');
    }
    
    public function down()
    {
        Schema::create('pensoft_partners_partners_countries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id');
            $table->integer('partners_id');
            $table->primary(['user_id','partners_id']);
        });
    }
}
