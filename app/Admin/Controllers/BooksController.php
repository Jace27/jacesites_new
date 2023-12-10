<?php

namespace App\Admin\Controllers;

use App\Models\Books;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BooksController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Books';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Books());

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('author', __('Author'));
        $grid->column('title', __('Title'));
        $grid->column('year', __('Year'));
        $grid->column('extension', __('Extension'));
        $grid->column('private', __('Private'))->switch();
        $grid->column('ord', __('Ord'));
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
        $show = new Show(Books::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('author', __('Author'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('year', __('Year'));
        $show->field('extension', __('Extension'));
        $show->field('private', __('Private'));
        $show->field('ord', __('Ord'));
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
        $form = new Form(new Books());

        $form->text('slug', __('Slug'));
        $form->text('author', __('Author'));
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->number('year', __('Year'));
        $form->text('extension', __('Extension'));
        $form->switch('private', __('Private'));
        $form->number('ord', __('Ord'))->default(100);

        return $form;
    }
}
