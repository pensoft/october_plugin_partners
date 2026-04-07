<?php

namespace Pensoft\Partners\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRainlabLocationCountries extends Migration
{
    public function up(): void
    {
        // if (!Schema::hasColumn('rainlab_location_countries', 'country_color')) {
        //     Schema::table('rainlab_location_countries', function (Blueprint $table) {
        //         $table->string('country_color')->nullable();
        //     });
        // }
    }

    public function down(): void
    {
        if (Schema::hasColumn('rainlab_location_countries', 'country_color')) {
            Schema::table('rainlab_location_countries', function (Blueprint $table) {
                $table->dropColumn('country_color');
            });
        }
    }
}