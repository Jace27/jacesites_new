<?php

namespace App\Admin\Controllers;

use App\Models\KkNotesRedirects;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KkNotesRedirectsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KkNotesRedirects';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KkNotesRedirects());

        $grid->column('id', __('Id'));
        $grid->column('old_link', __('Old link'));
        $grid->column('new_link', __('New link'));

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
        $show = new Show(KkNotesRedirects::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('old_link', __('Old link'));
        $show->field('new_link', __('New link'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new KkNotesRedirects());

        $form->text('old_link', __('Old link'));
        $form->text('new_link', __('New link'));

        return $form;
    }
}
