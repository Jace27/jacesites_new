<?php

namespace App\Admin\Controllers;

use App\Models\SitePages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SitePagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SitePages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SitePages());

        $grid->column('id', __('Id'));
        $grid->column('link', __('Link'));
        $grid->column('name', __('Name'));
        $grid->column('show_in_menu', __('Show in menu'));
        $grid->column('priority', __('Priority'));
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
        $show = new Show(SitePages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('link', __('Link'));
        $show->field('name', __('Name'));
        $show->field('show_in_menu', __('Show in menu'));
        $show->field('priority', __('Priority'));
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
        $form = new Form(new SitePages());

        $form->text('link', __('Link'));
        $form->text('name', __('Name'));
        $form->switch('show_in_menu', __('Show in menu'));
        $form->number('priority', __('Priority'))->default(100);

        return $form;
    }
}
