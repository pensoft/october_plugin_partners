<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftPartnersPartners extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pensoft_partners_partners')) {
            Schema::create('pensoft_partners_partners', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->text('content')->nullable();
                $table->integer('country_id')->nullable();
                $table->string('country_code', 2)->nullable();
                $table->string('title')->nullable();
                $table->integer('city_id')->nullable();
                $table->string('email')->nullable();
                $table->string('instituion')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('pensoft_partners_partners')) {
            Schema::dropIfExists('pensoft_partners_partners');
        }
    }
}
