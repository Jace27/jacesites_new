<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\RestoreAction;
use App\Admin\Selectable\ArticlesSelectable;
use App\Models\Articles;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Articles';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Articles());

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('author', __('Author'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'))->display(function ($var) {
            return mb_substr(strip_tags($var), 0, 1000).'...';
        });
        $grid->column('available_after', __('Available after'))->display(function ($id) {
            return Articles::whereId($id)->first()?->title;
        });
        $grid->column('ord', __('Ord'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

        $grid->actions(function (Grid\Displayers\DropdownActions $actions) {
            if ($actions->row->deleted_at) {
                $actions->add(new RestoreAction());
            }
        });

        $grid->filter(function (Grid\Filter $filter) {
            $filter->scope('trashed', __('Recycle Bin'))->onlyTrashed();
        });

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
        $show = new Show(Articles::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('author', __('Author'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('available_after', __('Available after'));
        $show->field('ord', __('Ord'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Articles());

        $form->text('slug', __('Slug'));
        $form->text('author', __('Author'));
        $form->text('title', __('Title'));
        $form->ckeditor('content', __('Content'));
        $form->belongsTo('available_after', ArticlesSelectable::class, __('Available after'));
        $form->number('ord', __('Ord'))->default(500);

        return $form;
    }
}
