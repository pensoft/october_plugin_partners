<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners2 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->integer('type')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->dropColumn('type');
        });
    }
}