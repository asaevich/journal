<?php

namespace App\Admin\Controllers;

use App\Models\Holiday;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HolidayController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Holiday';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Holiday());

        $grid->column('id', __('Id'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));

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
        $show = new Show(Holiday::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('holiday', __('Holiday'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Holiday());

        $form->textarea('holiday', __('Holiday'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));

        return $form;
    }
}
