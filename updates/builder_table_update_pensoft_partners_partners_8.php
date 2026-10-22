<?php namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners8 extends Migration
{
    public function up()
    {
        // Already there in a database upgraded from v2 (version 1.1.4).
        if (Schema::hasColumn('pensoft_partners_partners', 'topic_id')) {
            return;
        }

        Schema::table('pensoft_partners_partners', function($table)
        {
            $table->integer('topic_id')->nullable()->unsigned();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('pensoft_partners_partners', 'topic_id')) {
            Schema::table('pensoft_partners_partners', function($table)
            {
                $table->dropColumn('topic_id');
            });
        }
    }
}
