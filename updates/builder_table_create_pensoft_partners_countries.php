<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftPartnersCountries extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_partners_countries', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('country_id');
            $table->integer('partners_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_partners_countries');
    }
}