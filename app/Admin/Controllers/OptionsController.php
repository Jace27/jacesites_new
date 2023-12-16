<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\OptionPagesSelectable;
use App\Models\OptionPages;
use App\Models\Options;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OptionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Options';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Options());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('input_attrs', __('Input attrs'));
        $grid->column('type', __('Type'))->select(Options::getTypes());
        $grid->column('page_id', __('Page id'))->belongsTo(OptionPagesSelectable::class);
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
        $show = new Show(Options::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('input_attrs', __('Input attrs'));
        $show->field('type', __('Type'));
        $show->field('page_id', __('Page id'));
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
        $form = new Form(new Options());

        $form->text('name', __('Name'));
        $form->text('input_attrs', __('Input attrs'))->default('type="text"');
        $form->select('type', __('Type'))->options(Options::getTypes());
        $form->belongsTo('page_id', OptionPagesSelectable::class, __('Page id'));

        return $form;
    }
}
