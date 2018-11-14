<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Project extends Model
{
    protected $table = 'm_projects_d';

    protected $primaryKey = 'ID';

    protected $fillable = [
      'uid', 'ProjectsName', 'flowname', 'ModifyDatetime', 'sort', 'Amount'
    ];

    public function getProjectNameList($hid = null)
    {
        $projectNameList = [];
        if($hid){
            $projectNameListByDB = DB::table('m_projects_h')->select('ID', 'ProjectsName', 'BeginDatetime', 'EndDatetime','FinishFly')->where('ID',$hid)->get();
        }else{
            $projectNameListByDB = DB::table('m_projects_h')->select('ID', 'ProjectsName', 'BeginDatetime', 'EndDatetime', 'FinishFly')->orderBy('BeginDatetime','desc')->get();

        }
        foreach ($projectNameListByDB as $item){
            $projectNameList[$item->ID] =  [
                'hid' => $item->ID,
                'ProjectName' => $item->ProjectsName,
                'BeginDatetime' => $item->BeginDatetime,
                'EndDatetime' => $item->EndDatetime,
                'finish' => $item->FinishFly ==null ? 0:$item->FinishFly,
//                'EndDatetime' => (Carbon::createFromTimestampMs($item->EndDatetime.'.0000','Asia/Shanghai')->toTimeString()),
                'process' => [],
            ];
        }
        return $projectNameList;
    }

    public function getProcessNameList()
    {
        $processes = [];
        //进度列表
        $arr = DB::table('m_projects_d')->select('sort','flowname')->groupBy('sort','flowname')->get()->map(function($item){
            return [
                'sort' => $item->sort,
                'flowname' => $item->flowname
            ];
        });
        foreach ($arr as $process){
            $processes = array_add($processes,$process['sort'],$process);
        }
        return $processes;
    }

    public function getProjectProcessList($hid = null)
    {
        if(!$hid){
            return  DB::table($this->table)->select('hid', 'sort', 'ModifyDatetime', 'Amount', 'Nextsort')->whereNotNull('ModifyDatetime')->orderBy('hid')->orderBy('ModifyDatetime')->get()->map(function($item){
                return [
                    'hid' => $item->hid,
                    'sort' => $item->sort,
                    'processStartTime' =>  strtotime($item->ModifyDatetime),
                    'cost' => $item->Amount,
                    'nextSort' =>  $item->Nextsort
                ];
            });
        }else{
            return  DB::table($this->table)->select('hid', 'sort', 'ModifyDatetime','Amount')->whereNotNull('ModifyDatetime')->where('hid',$hid)->orderBy('hid')->orderBy('ModifyDatetime')->get()->map(function($item){
                return [
                    'hid' => $item->hid,
                    'sort' => $item->sort,
                    'processStartTime' => strtotime($item->ModifyDatetime),
                    'cost' => $item->Amount,
                ];
            });
        }

    }
}
