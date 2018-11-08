<?php

namespace App\Admin\Controllers;

use App\Project;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use Khill\Lavacharts\Lavacharts;
class ProjectProcessController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function index(Content $content)
//    {
//        return $content
//            ->header('Index')
//            ->description('description')
//            ->body($this->grid());
//    }

    public function index(Content $content)
    {
//        $lava = new Lavacharts;
//        $data = $lava->DataTable();
//
//        $data->addDateColumn('Day of Month')
//            ->addNumberColumn('Projected')
//            ->addNumberColumn('Official');
//
//// Random Data For Example
//        for ($a = 1; $a < 30; $a++) {
//            $rowData = [
//                "2017-4-$a", rand(800,1000), rand(800,1000)
//            ];
//
//            $data->addRow($rowData);
//        }
//        dd($data);
        return $content
            ->header('项目进度')
            ->row(function (Row $row) {
                $bar = view('admin.projectchart.bar');
                $row->column(12, new Box('Bar chart', $bar));
            });
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project);



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Project::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Project);



        return $form;
    }
}
