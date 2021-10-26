<?php

namespace App\Admin\Controllers;

use App\Models\Group;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GroupController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Group';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Group());

        $grid->column('id', __('Id'));
        $grid->column('specialty_id', __('Specialty id'));
        $grid->column('subgroup', __('Subgroup'));
        $grid->column('education_type_id', __('Education type id'));
        $grid->column('admission_year', __('Admission year'));

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
        $show = new Show(Group::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('specialty_id', __('Specialty id'));
        $show->field('subgroup', __('Subgroup'));
        $show->field('education_type_id', __('Education type id'));
        $show->field('admission_year', __('Admission year'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Group());

        $form->number('specialty_id', __('Specialty id'));
        $form->textarea('subgroup', __('Subgroup'));
        $form->number('education_type_id', __('Education type id'));
        $form->number('admission_year', __('Admission year'));

        return $form;
    }
}
