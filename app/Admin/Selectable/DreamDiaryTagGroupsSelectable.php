<?php

namespace App\Admin\Selectable;

use App\Models\DreamDiaryTagGroups;
use Encore\Admin\Grid\Filter;

class DreamDiaryTagGroupsSelectable extends \Encore\Admin\Grid\Selectable
{
    public $model = DreamDiaryTagGroups::class;

    /**
     * @inheritDoc
     */
    public function make()
    {
        $this->column('name');

        $this->filter(function (Filter $filer) {
            $filer->like('name');
        });
    }
}
