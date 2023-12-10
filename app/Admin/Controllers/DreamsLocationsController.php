<?php

namespace App\Admin\Controllers;

use App\Models\DreamsLocations;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DreamsLocationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DreamsLocations';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DreamsLocations());

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'))->display(function ($var) {
            return mb_substr(strip_tags($var), 0, 500).'...';
        });
        $grid->column('map_coords', __('Map coords'));
        $grid->column('map_shape', __('Map shape'))->select([
            'rect' => 'Прямоугольная',
            'circle' => 'Круг',
            'poly' => 'Многогранник',
        ]);
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
        $show = new Show(DreamsLocations::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('map_coords', __('Map coords'));
        $show->field('map_shape', __('Map shape'));
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
        $form = new Form(new DreamsLocations());

        $form->text('slug', __('Slug'));
        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->text('map_coords', __('Map coords'));
        $form->select('map_shape', __('Map shape'))->options([
            'rect' => 'Прямоугольная',
            'circle' => 'Круг',
            'poly' => 'Многогранник',
        ]);

        return $form;
    }
}
