<?php namespace Pensoft\Partners\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Migration;

class CreatePartnerTypesTable extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_partners_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('sort_order')->default(0);
        });

        DB::table('pensoft_partners_types')->insert([
            ['id' => 1, 'name' => 'Partners',      'sort_order' => 1],
            ['id' => 2, 'name' => 'Transnational',  'sort_order' => 2],
            ['id' => 3, 'name' => 'Virtual',        'sort_order' => 3],
            ['id' => 4, 'name' => 'Supporting',     'sort_order' => 4],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_partners_types');
    }
}
