<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners5 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->text('add_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->dropColumn('add_description');
        });
    }
}