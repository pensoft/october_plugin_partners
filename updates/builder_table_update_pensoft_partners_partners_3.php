<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners3 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->integer('parent_id')->nullable()->default(1);
            $table->integer('nest_left')->nullable()->default(1);
            $table->integer('nest_right')->nullable()->default(1);
            $table->integer('nest_depth')->nullable()->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->dropColumn('parent_id');
            $table->dropColumn('nest_left');
            $table->dropColumn('nest_right');
            $table->dropColumn('nest_depth');
        });
    }
}