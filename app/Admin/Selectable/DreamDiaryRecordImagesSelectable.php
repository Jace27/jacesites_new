<?php

namespace App\Admin\Selectable;

use App\Models\DreamDiaryRecordImages;
use Encore\Admin\Grid\Filter;

class DreamDiaryRecordImagesSelectable extends \Encore\Admin\Grid\Selectable
{
    public $model = DreamDiaryRecordImages::class;

    /**
     * @inheritDoc
     */
    public function make()
    {
        $this->column('id');
        $this->column('record_id');
        $this->column('filename');

        $this->filter(function (Filter $filer) {
            $filer->like('filename');
        });
    }
}
