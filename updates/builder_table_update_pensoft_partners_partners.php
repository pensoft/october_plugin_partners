<?php

namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pensoft_partners_partners', 'instituion_url')) {
            Schema::table('pensoft_partners_partners', function (Blueprint $table) {
                $table->string('instituion_url')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pensoft_partners_partners', 'instituion_url')) {
            Schema::table('pensoft_partners_partners', function (Blueprint $table) {
                $table->dropColumn('instituion_url');
            });
        }
    }
}