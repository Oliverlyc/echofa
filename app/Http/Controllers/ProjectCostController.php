<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectCostController extends Controller
{
    public function getProjectCost(Project $project,$hid = null)
    {
        $projectList = $project->getProjectNameList($hid);
        $processNameList = $project->getProcessNameList();
        $projectProcessList = $project->getProjectProcessList($hid);
        foreach ($projectProcessList as $process){
            $process['flowname'] = $processNameList[$process['sort']]['flowname'];
            $projectList[$process['hid']]['process'][$process['sort']] = $process;
        }
        return $projectList;
    }

    public function getProjectCostTable(Project $project,$hid = null)
    {
        $projectList = $this->getProjectCost($project, $hid);
        foreach($projectList as $hid=>$project){
            $table = \Lava::DataTable();

            $table->addStringColumn('工序')
                ->addNumberColumn('费用');
            foreach($project['process'] as $process){
                $table->addRow([$process['flowname'], $process['cost']]);
            }
            \Lava::TableChart('CostTable'.$hid, $table,[
                'height' => count($project['process'])*70,
                'width' => '100%',
                'showRowNumber' => false,
            ]);
        }
        return view('echofa.projectCost',['projectList' => $projectList]);

    }
}
