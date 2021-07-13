<?php

namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('pensoft_partners_partners', 'instituion_url')) {
            Schema::table('pensoft_partners_partners', function ($table) {
                $table->string('instituion_url')->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('pensoft_partners_partners', 'instituion_url')) {
            Schema::table('pensoft_partners_partners', function ($table) {
                $table->dropColumn('instituion_url');
            });
        }
    }
}
