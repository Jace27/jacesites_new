<?php

namespace App\Admin\Selectable;

use App\Models\Articles;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class ArticlesSelectable extends Selectable
{
    public $model = Articles::class;

    public function make()
    {
        $this->column('id');
        $this->column('slug');
        $this->column('author');
        $this->column('title');
        $this->column('available_after');

        $this->filter(function (Filter $filter) {
            $filter->like('slug');
            $filter->like('author');
            $filter->like('title');
        });
    }
}
