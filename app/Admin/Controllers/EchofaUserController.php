<?php

namespace App\Admin\Controllers;

use App\EchofaUser;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EchofaUserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
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
//    public function edit($id, Content $content)
//    {
//        return $content
//            ->header('Edit')
//            ->description('description')
//            ->body($this->form()->edit($id));
//    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function create(Content $content)
//    {
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->form());
//    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EchofaUser);

        $grid->disableCreateButton();
        $grid->disableFilter();
//        $grid->id('Id');
        $grid->usercode('Usercode');
        $grid->password('Password');
        $grid->usercname('Usercname');
//        $grid->deptcode('Deptcode');
//        $grid->jobtype('Jobtype');
//        $grid->email('Email');
//        $grid->disabled('Disabled');
//        $grid->state('State');
        $grid->createdate('Createdate');
//        $grid->deleteuser('Deleteuser');
//        $grid->deletedate('Deletedate');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });
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
        $show = new Show(EchofaUser::findOrFail($id));

        $show->id('Id');
        $show->usercode('Usercode');
        $show->password('Password');
        $show->usercname('Usercname');
        $show->deptcode('Deptcode');
        $show->jobtype('Jobtype');
        $show->email('Email');
        $show->disabled('Disabled');
        $show->state('State');
        $show->createdate('Createdate');
        $show->deleteuser('Deleteuser');
        $show->deletedate('Deletedate');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
//    protected function form()
//    {
//        $form = new Form(new EchofaUser);
//
//        $form->text('usercode', 'Usercode');
//        $form->password('password', 'Password');
//        $form->text('usercname', 'Usercname');
//        $form->text('deptcode', 'Deptcode');
//        $form->text('jobtype', 'Jobtype');
//        $form->email('email', 'Email');
//        $form->switch('disabled', 'Disabled');
//        $form->number('state', 'State');
//        $form->datetime('createdate', 'Createdate')->default(date('Y-m-d H:i:s'));
//        $form->text('deleteuser', 'Deleteuser');
//        $form->datetime('deletedate', 'Deletedate')->default(date('Y-m-d H:i:s'));
//
//        return $form;
//    }
}
