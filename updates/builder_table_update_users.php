<?php namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateUsers extends Migration
{
    public function up(): void
    {
        // if (!Schema::hasColumn('users', 'partner_id')) {
        //     Schema::table('users', function (Blueprint $table) {
        //         $table->integer('partner_id')->nullable();
        //     });
        // }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'partner_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('partner_id');
            });
        }
    }
}