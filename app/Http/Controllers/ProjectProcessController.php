<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Project;
use Carbon\Carbon;
class ProjectProcessController extends Controller
{
//    public function getProjectList(Project $project)
//    {
//        $projectProcess = [];
//        //项目列表
//        $projectList = $project->getProjectNameList();
//        $processNameList = $project->getProcessNameList();
//        $processCount = count($processNameList);
//        //项目进度列表
//        $projectProcessList = $project->getProjectProcessList();
//
//        foreach ($projectProcessList as $process){
//            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
//            $projectList[$process['hid']]['process'][$process['sort']] = $process;
////            array_push($projectList[$process['hid']]['process'],$process);
//        }
//        foreach($projectList as $hid=>$project) {
//            $endSort = 0;
//            $tmpProcess = $processNameList;
//
//            if ($project['process'] != null) {
////                $endProcess = end($project['process']);
//                $endProcess = array_last($project['process']);
//                $endSort = $endProcess['sort'];
//                foreach ($project['process'] as $sort=>$process){
//
//                    $nextProcessStartTime = next($project['process'])['processStartTime'];
//                    $processStartTime = $process['processStartTime'];
//                    $processEndTime = &$projectList[$hid]['process'][$sort]['processEndTime'];
//                    if(($processStartTime == $nextProcessStartTime)&&($nextProcessStartTime != null)){
//                        $processEndTime = Carbon::parse($nextProcessStartTime)->addDays(1)->format('Y-m-d');
//                    }else{
////                        $projectList[$hid]['process'][$sort]['processEndTime'] = (next($project['process'])['processStartTime'] != $projectList[$hid]['process'][$sort]['processStartTime'])?:strtotime("+2 day",next($project['process'])['processStartTime']);
//                        $projectList[$hid]['process'][$sort]['processEndTime'] = $nextProcessStartTime;
//                    }
//                }
//                $projectList[$hid]['process'][$endSort]['processEndTime'] = date('Y-m-d', time());
//
//                list($sorts, $values) = array_divide($project['process']);
//                array_except($sorts, [$endSort]);
//                array_except($tmpProcess, $sorts);
//            }
//
//            if ($endSort <= $processCount - 1) {
//                $projectList[$hid]['nextProcess'] = [];
////                foreach ($tmpProcess as $index => $item) {
////                    $nextProcess = next($tmpProcess);
////                    if ($index == $endSort) {
////                        break;
////                    }
////                }
//                $projectList[$hid]['nextProcess'] = array_first($tmpProcess, function($value, $key) use($endSort){
//                    return $endSort < $key;
//                }, array_first($tmpProcess));
//                $projectList[$hid]['nextProcess']['processStartTime'] = date('Y-m-d', time());
//                $projectList[$hid]['nextProcess']['processEndTime'] = date('Y-m-d', strtotime("+2 day"));
//                $projectList[$hid]['nextProcess']['hid'] = $hid;
////                if ($nextProcess != null) {
////                    $projectList[$key]['nextProcess'] = $nextProcess;
////                } else {
////                    $projectList[$key]['nextProcess'] = reset($tmpProcess);
////                }
//            }
//        }
//        return $projectList;
//
//    }

//    public function getProjectList(Project $project)
//    {
//        $projectProcess = [];
//        //项目列表
//        $projectList = $project->getProjectNameList();
//        $processNameList = $project->getProcessNameList();
//        $processCount = count($processNameList);
//        //项目进度列表
//        $projectProcessList = $project->getProjectProcessList();
//
//
//        foreach ($projectProcessList as $process){
//            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
//            $projectList[$process['hid']]['process'][$process['sort']] = $process;
//        }
//
//        foreach($projectList as $hid=>$project) {
//            $endSort = 0;
//            $tmpProcess = $processNameList;
//            $projectList[$hid]['nextProcess'] = [];
//            if ($project['process'] != null) {
//                $endProcess = array_last($project['process']);
//                $endSort = $endProcess['sort'];
//                $nextSort = $endProcess['nextSort'];
//                foreach ($project['process'] as $sort=>$process){
//
//                    $nextProcessStartTime = next($project['process'])['processStartTime'];
//                    $processStartTime = $process['processStartTime'];
//                    $processEndTime = &$projectList[$hid]['process'][$sort]['processEndTime'];
//                    if((($processStartTime == $nextProcessStartTime)&&($nextProcessStartTime != null))&&($nextProcessStartTime != date('Y-m-d', time()))){
//                        $processEndTime = Carbon::parse($nextProcessStartTime)->addDays(1)->format('Y-m-d');
//                    }elseif ($nextProcessStartTime == date('Y-m-d', time())){
//                        $processEndTime = date('Y-m-d', time());
//                    }else{
//                        $processEndTime = $nextProcessStartTime;
//                    }
//                }
//                $projectList[$hid]['process'][$endSort]['processEndTime'] = date('Y-m-d', time());
//            }
//
//            if ($nextSort) {
//                $projectList[$hid]['nextProcess'] = $processNameList[$nextSort];
//                $projectList[$hid]['nextProcess']['processStartTime'] = date('Y-m-d', time());
//                $projectList[$hid]['nextProcess']['processEndTime'] = date('Y-m-d', strtotime("+2 day"));
//                $projectList[$hid]['nextProcess']['hid'] = $hid;
//            }
//        }
////dd($projectList);
//        return $projectList;
//
//    }
    public $type = [
        'processing' => 0,
        'finish' => 1
    ];

    public function getProjectList($project, $type)
    {
        $projectProcess = [];
        //项目列表
        $projectList = $project->getProjectNameList($this->type[$type]);
        $processNameList = $project->getProcessNameList();
        $processCount = count($processNameList);
        //项目进度列表
        $projectProcessList = $project->getProjectProcessList($this->type[$type]);
        foreach ($projectProcessList as $process){
            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
            $projectList[$process['hid']]['process'][$process['sort']] = $process;
        }
        foreach($projectList as $hid=>$project) {
            $endSort = 0;
            $nextSort = null;
            $projectList[$hid]['nextProcess'] = [];
            if ($project['process'] != null) {
                $endProcess = array_last($project['process']);
                $endSort = $endProcess['sort'];
                $nextSort = $endProcess['nextSort'];

                foreach ($project['process'] as $sort=>$process){

                    $nextProcessStartTime = next($project['process'])['processStartTime'];
                    $processStartTime = $process['processStartTime'];
                    $processEndTime = &$projectList[$hid]['process'][$sort]['processEndTime'];

                    if ($nextProcessStartTime == time()){
                        $processEndTime = time();
                    }else{
                        if(($nextProcessStartTime - $processStartTime)/86400 <1){
                            $processEndTime = $processStartTime;
                        }else{
                            $processEndTime = $nextProcessStartTime-86400;

                        }
                    }
                }

                if($project['finish'] === 1 ){
                    $projectList[$hid]['process'][$endSort]['processEndTime'] = strtotime("+2 day",$project['process'][$endSort]['processStartTime']);
                }elseif ($nextSort !== null  && $project['finish'] != 1 && count($project['process']) !== 1) {
                    $projectList[$hid]['process'][$endSort]['processEndTime'] = strtotime("-1 day");
                    $projectList[$hid]['nextProcess'] = $processNameList[$nextSort];
                    $projectList[$hid]['nextProcess']['processStartTime'] = time();
                    $projectList[$hid]['nextProcess']['processEndTime'] = strtotime("+".$endProcess["nextSortDays"]." day");
                    $projectList[$hid]['nextProcess']['hid'] = $hid;
                }
                elseif($nextSort !== null  && $project['finish'] != 1 && count($project['process']) === 1){
                    if(!array_first($project['process'])['processStartTime']){
                        $projectList[$hid]['process'] = [];
                    }else{
                        $projectList[$hid]['process'][$endSort]['processEndTime'] = strtotime("-1 day");
                    }
                    $projectList[$hid]['nextProcess']  = $processNameList[$nextSort];
                    $projectList[$hid]['nextProcess']['processStartTime'] = time();
                    $projectList[$hid]['nextProcess']['processEndTime'] = strtotime("+".$endProcess["nextSortDays"]." day");
                    $projectList[$hid]['nextProcess']['hid'] = $hid;
                }
                else{
                    $projectList[$hid]['process'][$endSort]['processEndTime'] = strtotime("+2 day",$project['process'][$endSort]['processStartTime']);
                }


            }


        }
//        dd($projectList);
        return $projectList;

    }

    public function format($projectList)
    {
        $color = [
            true => 'ganttRed',
            false => null
        ];
        $str = "[";
        foreach ($projectList as $hid => $project){
            $i = 0;
            $str .= "{name:'"
                .'<a href='.'"./project_cost/'.$project['hid'].'"'.'>'.$project['ProjectName'].'</a>'.
                "',desc:'".Carbon::parse($project['EndDatetime'])->format('Y-m-d').
                "',values:[";
            foreach ($project['process'] as $sort => $process){
                $str .= "{from:".$process['processStartTime'].'000'.
                    ",to:".$process['processEndTime'].'000'.
                    ",label:'".$process['flowname'].
                    "',customClass: '".$color[$i%2]."'},";
                $i++;
            }
            if($project['nextProcess']){
                $str .= "{from:".$project['nextProcess']['processStartTime'].'000'.
                    ",to:".$project['nextProcess']['processEndTime'].'000'.
                    ",label:'".$project['nextProcess']['flowname'].
                    "',customClass: 'ganttGreen'},";
            }
            $str .= "],},";
        }
        $str .= "]";
        return $str;
    }
    public function getGanttChart(Project $project ,Request $request)
    {
        $type= $request->query('type') ?? 'processing';
        $projectList = $this->getProjectList($project, $type);
        $projectList = $this->format($projectList);
//        dd($projectList);
        return view('echofa.projectProcess',['projectList' => $projectList]);
    }
}
