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
        }
        return $projectList;
    }

    public function getProjectCostTable(Project $project, $hid = null, Request $request)
    {
        $type= $request->query('type') ?? 'processing';
        $type = $this->type[$type];
        $projectList = $this->getProjectCost($project, $hid, $type);
        return view('echofa.projectCost',['projectList' => $projectList]);

    }
}
