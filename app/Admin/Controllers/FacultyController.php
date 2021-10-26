<?php

namespace App\Admin\Controllers;

use App\Models\Faculty;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FacultyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Faculty';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Faculty());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('abbreviation', __('Abbreviation'));

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
        $show = new Show(Faculty::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('abbreviation', __('Abbreviation'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Faculty());

        $form->textarea('name', __('Name'));
        $form->textarea('abbreviation', __('Abbreviation'));

        return $form;
    }
}
