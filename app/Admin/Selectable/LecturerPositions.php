<?php

namespace App\Admin\Selectable;

use App\Models\LecturerPosition;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Filter;

class LecturerPositions extends \Encore\Admin\Grid\Selectable
{
    public $model = LecturerPosition::class;

    public function make()
    {
        $this->column('id');
        $this->column('position', __('Должность'));

        $this->filter(function (Filter $filter) {
            $filter->like('position', __(''));
        });
    }
}
