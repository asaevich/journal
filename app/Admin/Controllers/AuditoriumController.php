<?php

namespace App\Admin\Controllers;

use App\Models\Auditorium;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AuditoriumController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Auditorium';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Auditorium());

        $grid->column('id', __('Id'));
        $grid->column('building_number', __('Building number'));
        $grid->column('auditorium_number', __('Auditorium number'));

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
        $show = new Show(Auditorium::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('building_number', __('Building number'));
        $show->field('auditorium_number', __('Auditorium number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Auditorium());

        $form->number('building_number', __('Building number'));
        $form->number('auditorium_number', __('Auditorium number'));

        return $form;
    }
}
