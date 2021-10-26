<?php

namespace App\Admin\Selectable;

use App\Models\Department;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class Departments extends Selectable
{
    public $model = Department::class;

    public function make()
    {
        $this->column('id');
        $this->column('name', __('Кафедра'));
        $this->column('abbreviation', __('Аббревиатура'));
        $this->column('faculty.name', __('Факультет'));

        $this->filter(function (Filter $filter) {
            $filter->like('name', __('Кафедра'));
        });
    }
}
