<?php
/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 4/14/16
 * Time: 5:18 PM
 */

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MigrateController extends Controller
{

    public function testDualDatabaseConnection()
    {
        /**
         * This is the SQL code which we are taking web data and other main fields.
         * mysql2 connection means the hosted database server connection.
         */
        $testGene = DB::connection('mysql2')->select('select a.analysis_id, logic_name, ad.description, ad.display_label, ad.web_data FROM ( select distinct(analysis_id) as analysis_id from gene ) as a join analysis on (a.analysis_id = analysis.analysis_id) join analysis_description as ad on (analysis.analysis_id = ad.analysis_id) where ad.displayable =  :wow1', ['wow1' => "1"]);

        /**
         * This is the SQL code which we are taking all the fields required for genome.
         */
        $testGene1 = DB::connection('mysql2')->select('select * from meta where meta_key IN (\'assembly.default\', \'species.production_name\', \'species.strain_collection\', \'species.division\', \'schema_type\');');

        /**
         * From this code, we can insert rows to our new database.
         * Currently this is in my local machine.
         */
        $insertDemo = DB::table('track_type')->insertGetId(
            ['track_type_id' => '3', 'track_type_name' => "test_name_track_1"]
        );

        /**
         * This is the select command which we can use to search all the local database tables.
         */
        $testTrack = DB::select('SELECT * FROM track_type');

        return response()->json(array("big" => $testGene, "small" => $testGene1, "insert" => $insertDemo, "test_track" => $testTrack));
    }
}
