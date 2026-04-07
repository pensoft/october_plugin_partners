<?php namespace Pensoft\Partners\Updates;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

class MigrateCountryToBelongsTo extends Migration
{
    public function up(): void
    {
        // Populate country_id from the pivot table (take first country for each partner)
        if (Schema::hasTable('pensoft_partners_countries')) {
            $pivotRecords = DB::table('pensoft_partners_countries')
                ->select('partners_id', DB::raw('MIN(country_id) as country_id'))
                ->groupBy('partners_id')
                ->get();

            foreach ($pivotRecords as $record) {
                DB::table('pensoft_partners_partners')
                    ->where('id', $record->partners_id)
                    ->whereNull('country_id')
                    ->update(['country_id' => $record->country_id]);
            }
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
}
