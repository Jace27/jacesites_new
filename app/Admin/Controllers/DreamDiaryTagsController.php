<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\DreamDiaryTagGroupsSelectable;
use App\Models\DreamDiaryTags;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DreamDiaryTagsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DreamDiaryTags';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DreamDiaryTags());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('group_id', __('Group id'))->belongsTo(DreamDiaryTagGroupsSelectable::class);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(DreamDiaryTags::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('group_id', __('Group id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DreamDiaryTags());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->belongsTo('group_id', DreamDiaryTagGroupsSelectable::class, __('Group id'));

        return $form;
    }
}
