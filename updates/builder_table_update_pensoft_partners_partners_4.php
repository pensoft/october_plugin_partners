<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftPartnersPartners4 extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->integer('parent_id')->nullable()->default(null)->change();
            $table->integer('nest_left')->nullable()->default(null)->change();
            $table->integer('nest_right')->nullable()->default(null)->change();
            $table->integer('nest_depth')->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        DB::table('pensoft_partners_partners')->whereNull('parent_id')->update(['parent_id' => 1]);
        DB::table('pensoft_partners_partners')->whereNull('nest_left')->update(['nest_left' => 1]);
        DB::table('pensoft_partners_partners')->whereNull('nest_right')->update(['nest_right' => 1]);
        DB::table('pensoft_partners_partners')->whereNull('nest_depth')->update(['nest_depth' => 1]);

        Schema::table('pensoft_partners_partners', function(Blueprint $table)
        {
            $table->integer('parent_id')->nullable(false)->default(1)->change();
            $table->integer('nest_left')->nullable(false)->default(1)->change();
            $table->integer('nest_right')->nullable(false)->default(1)->change();
            $table->integer('nest_depth')->nullable(false)->default(1)->change();
        });
    }
}