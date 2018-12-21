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


    public function getProjectNameList($type = 0,$hid = null)
    {
        $projectNameList = [];
        if($hid){
            $projectNameListByDB = DB::table('m_projects_h')->select('ID', 'ProjectsName' ,'CorpName', 'BeginDatetime', 'EndDatetime','FinishFly')->where('ID',$hid)->get();
        }else{
            $projectNameListByDB = DB::table('m_projects_h')->select('ID', 'ProjectsName' ,'CorpName', 'BeginDatetime', 'EndDatetime', 'FinishFly')->where('FinishFly',$type)->orderBy('BeginDatetime','desc')->get();

        }
        foreach ($projectNameListByDB as $item){
            $projectNameList[$item->ID] =  [
                'hid' => $item->ID,
                'ProjectName' => $item->CorpName.$item->ProjectsName,
                'BeginDatetime' => $item->BeginDatetime,
                'EndDatetime' => $item->EndDatetime,
                'finish' => $item->FinishFly ==null ? 0:$item->FinishFly,
                'total' => 0,
//                'EndDatetime' => (Carbon::createFromTimestampMs($item->EndDatetime.'.0000','Asia/Shanghai')->toTimeString()),
                'process' => [],
            ];
        }
        return $projectNameList;
    }
    public function getProjectHid($type)
    {
        return DB::table('m_projects_h')->select('ID')->where('FinishFly',$type)->get()->map(function($item){
            return [
                'hid' => $item->ID
            ];
        });
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

    public function getProjectProcessList($type = 0,$hid = null)
    {
        $projectHidList = array_pluck($this->getProjectHid($type),'hid');
        if(!$hid){
                $modifyDatetimeIsNotNull =  DB::table($this->table)->select('hid', 'sort', 'ModifyDatetime', 'Amount', 'Nextsort', 'NextPlanDate')->whereRaw('ModifyDatetime is not null or Nextsort is not null')->orderBy('hid')->orderBy('ModifyDatetime')->get()->map(function($item){
                return [
                    'hid' => $item->hid,
                    'sort' => $item->sort,
                    'processStartTime' =>  strtotime($item->ModifyDatetime),
                    'cost' => $item->Amount,
                    'nextSort' =>  $item->Nextsort,
                    'nextSortDays' => $item->NextPlanDate
                ];
            })->toArray();
            $modifyDatetimeIsNotNull = array_where($modifyDatetimeIsNotNull, function($value, $key) use ($projectHidList){
                if(in_array($value['hid'], $projectHidList)) return true;
            });
            return $modifyDatetimeIsNotNull;
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
