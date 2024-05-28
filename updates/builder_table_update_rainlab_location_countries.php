<?php

namespace Pensoft\Partners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRainlabLocationCountries extends Migration
{
    public function up()
    {
        // if (!Schema::hasColumn('rainlab_location_countries', 'country_color')) {
        //     Schema::table('rainlab_location_countries', function ($table) {
        //         $table->string('country_color')->nullable();
        //     });
        // }
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_location_countries', 'country_color')) {
            Schema::table('rainlab_location_countries', function ($table) {
                $table->dropColumn('country_color');
            });
        }
    }
}
