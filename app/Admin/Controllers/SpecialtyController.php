<?php

namespace App\Admin\Controllers;

use App\Models\Specialty;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SpecialtyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Specialty';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Specialty());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('abbreviation', __('Abbreviation'));
        $grid->column('department_id', __('Department id'));

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
        $show = new Show(Specialty::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('abbreviation', __('Abbreviation'));
        $show->field('department_id', __('Department id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Specialty());

        $form->textarea('name', __('Name'));
        $form->textarea('abbreviation', __('Abbreviation'));
        $form->number('department_id', __('Department id'));

        return $form;
    }
}
