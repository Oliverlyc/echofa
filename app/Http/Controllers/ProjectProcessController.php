<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Project;
use Carbon\Carbon;
class ProjectProcessController extends Controller
{
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
//            array_push($projectList[$process['hid']]['process'],$process);
        }
        foreach($projectList as $hid=>$project) {
            $endSort = 0;
            $tmpProcess = $processNameList;

            if ($project['process'] != null) {
//                $endProcess = end($project['process']);
                $endProcess = array_last($project['process']);
                $endSort = $endProcess['sort'];
                foreach ($project['process'] as $sort=>$process){

                    $nextProcessStartTime = next($project['process'])['processStartTime'];
                    $processStartTime = $process['processStartTime'];
                    $processEndTime = &$projectList[$hid]['process'][$sort]['processEndTime'];
                    if(($processStartTime == $nextProcessStartTime)&&($nextProcessStartTime != null)){
                        $processEndTime = Carbon::parse($nextProcessStartTime)->addDays(1)->format('Y-m-d');
                    }else{
//                        $projectList[$hid]['process'][$sort]['processEndTime'] = (next($project['process'])['processStartTime'] != $projectList[$hid]['process'][$sort]['processStartTime'])?:strtotime("+2 day",next($project['process'])['processStartTime']);
                        $projectList[$hid]['process'][$sort]['processEndTime'] = $nextProcessStartTime;
                    }
                }
                $projectList[$hid]['process'][$endSort]['processEndTime'] = date('Y-m-d', time());

                list($sorts, $values) = array_divide($project['process']);
                array_except($sorts, [$endSort]);
                array_except($tmpProcess, $sorts);
            }

            if ($endSort <= $processCount - 1) {
                $projectList[$hid]['nextProcess'] = [];
//                foreach ($tmpProcess as $index => $item) {
//                    $nextProcess = next($tmpProcess);
//                    if ($index == $endSort) {
//                        break;
//                    }
//                }
                $projectList[$hid]['nextProcess'] = array_first($tmpProcess, function($value, $key) use($endSort){
                    return $endSort < $key;
                }, array_first($tmpProcess));
                $projectList[$hid]['nextProcess']['processStartTime'] = date('Y-m-d', time());
                $projectList[$hid]['nextProcess']['processEndTime'] = date('Y-m-d', strtotime("+2 day"));
                $projectList[$hid]['nextProcess']['hid'] = $hid;
//                if ($nextProcess != null) {
//                    $projectList[$key]['nextProcess'] = $nextProcess;
//                } else {
//                    $projectList[$key]['nextProcess'] = reset($tmpProcess);
//                }
            }
        }
        return $projectList;

    }

    public function getGanttChart(Project $project)
    {
        $projectList = $this->getProjectList($project);
        foreach ($projectList as $hid => $project)
        {
            $table = \Lava::DataTable();
            \Lava::DateFormat([
                'formatType' => 'short',
                'pattern' => 'EEE,MMM d,yy'
            ]);
            $table->addStringColumn('Task ID')
                ->addStringColumn('Task Name')
                ->addStringcolumn('Resource')
                ->addDateColumn('Start Date')
                ->addDateColumn('End Date')
                ->addNumberColumn('Duration')
                ->addNumberColumn('Percent Complete')
                ->addStringColumn('Demendencies');
            foreach($project['process'] as $item){
                $table->addRow([$item['sort'], $item['flowname'], null, $item['processStartTime'], $item['processEndTime'], null, 100, null,]);
            }
            $table->addRow([$project['nextProcess']['sort'], $project['nextProcess']['flowname'], 'future', $project['nextProcess']['processStartTime'], $project['nextProcess']['processEndTime'], null, 100, null,]);
            \Lava::GanttChart('Gantt'.$hid,$table,[
                'height' => (count($project['process'])+1)*35+50,
                'gantt' => [ 'barHeight' => 18]
            ]);
        }

        return view('echofa.projectProcess',['projectList' => $projectList]);

    }
}
