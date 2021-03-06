<?php namespace Olabs\Oims\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateOlabsOimsQuotes5 extends Migration
{
    public function up()
    {
        Schema::table('olabs_oims_quotes', function($table)
        {
            $table->string('reference_number')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('olabs_oims_quotes', function($table)
        {
            $table->dropColumn('reference_number');
        });
    }
}
