<?php

namespace App\Admin\Selectable;

use App\Models\OptionPages;
use Encore\Admin\Grid\Filter;

class OptionPagesSelectable extends \Encore\Admin\Grid\Selectable
{
    public $model = OptionPages::class;

    /**
     * @inheritDoc
     */
    public function make()
    {
        $this->column('name');

        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
