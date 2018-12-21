<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
class ProjectCostController extends Controller
{
    public $type = [
        'processing' => 0,
        'finish' => 1
    ];



    public function getProjectCost(Project $project,$hid = null, $type)
    {
        $projectList = $project->getProjectNameList($type, $hid);
        $processNameList = $project->getProcessNameList();
        $projectProcessList = $project->getProjectProcessList($type, $hid);
        foreach ($projectProcessList as $process){
            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
            $projectList[$process['hid']]['process'][$process['sort']] = $process;
            $projectList[$process['hid']]['total'] += $process['cost'];
        }
        return $projectList;
    }

    public function getProjectCostTable(Project $project, $hid = null, Request $request)
    {
        $type = $request->query('type') ?? 'processing';
        $type = $this->type[$type];
        $projectList = $this->getProjectCost($project, $hid, $type);
//        dd($projectList);
        return view('echofa.projectCost',['projectList' => $projectList]);

    }

    public function getProcessCostList(Project $project, $hid, Request $request)
    {
        $type = $request->query('type') ?? 'processing';
        $data = $this->getProjectCost($project, $hid, $type);
        $inf = collect($data)->map(function($item, $index){
            $arr = [];
            $arr['项目名称'] = ['项目名称', $item['ProjectName']];
            foreach ($item['process'] as $sort => $process){
                $arr[$sort] = [$process['flowname'], $process['cost']];
            }
            $arr['总计'] = ['总计',$item['total']];
            return $arr;
        })->first();
        return collect($inf)->downloadExcel($inf['项目名称'][1].'.xls', null);
    }
}
