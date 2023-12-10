<?php

namespace App\Admin\Controllers;

use App\Models\KkNotes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KkNotesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KkNotes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KkNotes());

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('name', __('Name'));
        $grid->column('content', __('Content'))->display(function ($var) {
            return mb_substr(strip_tags($var), 0, 1000).'...';
        });
        $grid->column('active', __('Active'));
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
        $show = new Show(KkNotes::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('name', __('Name'));
        $show->field('content', __('Content'));
        $show->field('active', __('Active'));
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
        $form = new Form(new KkNotes());

        $form->text('slug', __('Slug'));
        $form->text('name', __('Name'));
        $form->ckeditor('content', __('Content'));
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
