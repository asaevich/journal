<?php

namespace App\Admin\Controllers;

use App\Models\Lesson;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LessonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $grid->column('id', __('Id'));
        $grid->column('subject_id', __('Subject id'));
        $grid->column('employment_type_id', __('Employment type id'));
        $grid->column('auditorium_id', __('Auditorium id'));
        $grid->column('lesson_type_id', __('Lesson type id'));
        $grid->column('start_date', __('Start date'));
        $grid->column('end_date', __('End date'));
        $grid->column('week_day', __('Week day'));
        $grid->column('week_type', __('Week type'));
        $grid->column('number', __('Number'));

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
        $show = new Show(Lesson::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('subject_id', __('Subject id'));
        $show->field('employment_type_id', __('Employment type id'));
        $show->field('auditorium_id', __('Auditorium id'));
        $show->field('lesson_type_id', __('Lesson type id'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('week_day', __('Week day'));
        $show->field('week_type', __('Week type'));
        $show->field('number', __('Number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lesson());

        $form->number('subject_id', __('Subject id'));
        $form->number('employment_type_id', __('Employment type id'));
        $form->number('auditorium_id', __('Auditorium id'));
        $form->number('lesson_type_id', __('Lesson type id'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));
        $form->textarea('week_day', __('Week day'));
        $form->textarea('week_type', __('Week type'));
        $form->number('number', __('Number'));

        return $form;
    }
}
