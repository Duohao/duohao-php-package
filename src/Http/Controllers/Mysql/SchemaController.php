<?php
namespace Std\Http\Controllers\Scheme;

use DB;
use Illuminate\Http\Request;
use \Std\Helpers\MysqlHelper;

class DbController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tableName)
    {
        $mysqlHelper = new MysqlHelper();
        $return = new \stdClass;
        $return->table = $tableName;
        $return->primaryKey = $mysqlHelper->getPrimaryKey($tableName);
        $return->columns = $mysqlHelper->convertColumnsToAntdTableColumns($mysqlHelper->getColumnInfo($tableName));
        $return->data = DB::table($tableName)->OrderBy($return->primaryKey, "desc")->paginate(50);
        return (new \Std\Response\BaseResponse(200, $return))->output();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($table, $field, $operator = '=', $value)
    {
        $return = DB::table($table)->where($field, $operator, $value)->get();
        $mysqlHelper = new \Std\Helpers\MysqlHelper();
        //Find Relation tables and set value
        $relationTableFields = [];
        $relationTables = DB::table('database_settings.mysql_table_relations')
            ->where('table', $table)->get();
        foreach ($relationTables as $rkey => $rvalue) {
            $relationTableFields[$rvalue->table_field] = [$rvalue->relate_table, $rvalue->relate_table_field];
        }
        $returnTableFields = $mysqlHelper->getPrivateFields($table);
        foreach ($return as $key => $value) {
            foreach ($value as $field => $fieldValue) {
                if (in_array($field, $returnTableFields)) {
                    unset($return[$key]->$field);
                    continue;
                }
                if (isset($relationTableFields[$field])) {
                    $rel =
                    DB::table($relationTableFields[$field][0])->where($relationTableFields[$field][1], '=', $return[$key]->$field)->get();
                    $relTableFields = $mysqlHelper->getPrivateFields($relationTableFields[$field][0]);
                    foreach ($rel as $relkey => $relvalues) {
                        foreach ($relvalues as $relk => $relv) {
                            if (in_array($relk, $relTableFields)) {
                                unset($rel[$relkey]->$relk);
                                continue;
                            }
                        }
                    }
                    $return[$key]->{$field . '_rel'} = $rel->count() === 1 ? $rel[0] : $rel;
                }
            }
        }
        if ($return->count() === 1) {
            $return = $return[0];
        }
        return (new \Std\Response\BaseResponse(200, $return))->output();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
