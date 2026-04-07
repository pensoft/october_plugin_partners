<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners6 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->string('country_code', 255)->change();
        });
    }

    public function down(): void
    {

        // Schema::table('pensoft_partners_partners', function(Blueprint $table)
        // {
        //     $table->string('country_code', 2)->change();
        // });
    }
}