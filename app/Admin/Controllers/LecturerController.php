<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\Departments;
use App\Admin\Selectable\LecturerPositions;
use App\Models\Lecturer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LecturerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Преподаватели';

    protected function grid(): Grid
    {
        $grid = new Grid(new Lecturer());

        $grid->column('id', __('Id'));
        $grid->column('last_name', __('Фамилия'));
        $grid->column('first_name', __('Имя'));
        $grid->column('middle_name', __('Отчество'));
        $grid->column('department.name', __('Кафедра'));
        $grid->column('position.position', __('Должность'));
        $grid->column('username', __('Логин'));
        $grid->column('created_at', __('Создан'));

        return $grid;
    }

    protected function detail($id): Show
    {
        $show = new Show(Lecturer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('last_name', __('Last name'));
        $show->field('first_name', __('First name'));
        $show->field('middle_name', __('Middle name'));
        $show->field('department_id', __('Department id'));
        $show->field('position_id', __('Position id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form(): Form
    {
        $form = new Form(new Lecturer());

        $form->textarea('last_name', __('Фамилия'));
        $form->textarea('first_name', __('Имя'));
        $form->textarea('middle_name', __('Отчество'));
        $form->belongsTo('department_id', Departments::class, __('Кафедра'));
        $form->belongsTo('position_id', LecturerPositions::class, __('Должность'));
        $form->textarea('username', __('Логин'));
        $form->textarea('password', __('Пароль'));

        return $form;
    }
}
