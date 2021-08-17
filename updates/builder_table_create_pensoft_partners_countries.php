<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftPartnersCountries extends Migration
{
    public function up()
    {
        Schema::create('pensoft_partners_countries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('country_id');
            $table->integer('partners_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_partners_countries');
    }
}
