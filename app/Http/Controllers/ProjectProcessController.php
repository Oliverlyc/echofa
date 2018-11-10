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
    public function getProjectList(Project $project)
    {
        $projectProcess = [];
        //项目列表
        $projectList = $project->getProjectNameList();
        $processNameList = $project->getProcessNameList();
        $processCount = count($processNameList);
        //项目进度列表
        $projectProcessList = $project->getProjectProcessList();

        foreach ($projectProcessList as $process){
            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
            $projectList[$process['hid']]['process'][$process['sort']] = $process;
        }

        foreach($projectList as $hid=>$project) {
            $endSort = 0;
            $tmpProcess = $processNameList;
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
                $projectList[$hid]['process'][$endSort]['processEndTime'] = strtotime("-1 day");


            }

            if ($nextSort) {
                $projectList[$hid]['nextProcess'] = $processNameList[$nextSort];
                $projectList[$hid]['nextProcess']['processStartTime'] = time();
                $projectList[$hid]['nextProcess']['processEndTime'] = strtotime("+2 day");
                $projectList[$hid]['nextProcess']['hid'] = $hid;
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
//            $str .= "{name:'"
//                .'<a href='.'"./project_cost/'.$project['hid'].'"'.'>'.$project['ProjectName'].'</a>'.
//                "',desc:'".Carbon::parse($project['EndDatetime'])->format('Y-m-d').
//                "',values:[{from:".strtotime($project['BeginDatetime']).'000'.
//                ",to:".strtotime($project['EndDatetime']).'000'.
//                ",label:'".$project['ProjectName'].
//                "',customClass:'ganttRed'},";
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
    public function getGanttChart(Project $project)
    {

        $projectList = $this->getProjectList($project);
        $projectList = $this->format($projectList);
//        dd($projectList);
        return view('echofa.projectProcess',['projectList' => $projectList]);
    }
//    public function getGanttChart(Project $project)
//    {
//        $projectList = $this->getProjectList($project);
//        foreach ($projectList as $hid => $project)
//        {
//            if($project['process']) {
//
//                $table = \Lava::DataTable();
//                $format = \Lava::DateFormat([
//                    'formatType' => 'short',
//                    'pattern' => 'Y,m,d',
//                    'timezone' => 'Asia/Shanghai'
//                ]);
//                $table->addStringColumn('Task ID')
//                    ->addStringColumn('Task Name')
//                    ->addStringcolumn('Resource')
//                    ->addDateColumn('Start Date',$format)
//                    ->addDateColumn('End Date')
//                    ->addNumberColumn('Duration')
//                    ->addNumberColumn('Percent Complete')
//                    ->addStringColumn('Dependencies')
//                    ;
//                foreach ($project['process'] as $item) {
//                    $table->addRow([$item['sort'], $item['flowname'], null, $item['processStartTime'], $item['processEndTime'], null,100]);
//                }
//                if ($project['nextProcess']) {
//                    $table->addRow([$project['nextProcess']['sort'], $project['nextProcess']['flowname'], 'future', $project['nextProcess']['processStartTime'], $project['nextProcess']['processEndTime'], null,100]);
//                }
//
//                \Lava::GanttChart('Gantt' . $hid, $table, [
//                    'height' => (count($project['process']) + 1) * 36 + 50,
//                    'gantt' => ['barHeight' => 19,'labelStyle' =>['fontSize' => 18]],
//                ]);
//            }
//        }
//
//        return view('echofa.projectProcess',['projectList' => $projectList]);
//
//    }
}
