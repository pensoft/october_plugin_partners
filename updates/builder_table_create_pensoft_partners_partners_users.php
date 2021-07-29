<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftPartnersPartnersUsers extends Migration
{
    public function up()
    {
        Schema::create('pensoft_partners_partners_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id');
            $table->integer('partners_id');
            $table->primary(['user_id','partners_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pensoft_partners_partners_users');
    }
}
