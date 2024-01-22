<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\DreamDiaryRecordImagesSelectable;
use App\Admin\Selectable\UserSelectable;
use App\Models\MapLocations;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MapLocationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MapLocations';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MapLocations());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('image_id', __('Image id'));
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
        $show = new Show(MapLocations::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('image_id', __('Image id'));
        $show->field('x', __('X'));
        $show->field('y', __('Y'));
        $show->field('w', __('W'));
        $show->field('h', __('H'));
        $show->field('r', __('R'));
        $show->field('z', __('Z'));
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
        $form = new Form(new MapLocations());

        $form->belongsTo('user_id', UserSelectable::class, __('User id'));
        $form->belongsTo('image_id', DreamDiaryRecordImagesSelectable::class, __('Image id'));
        $form->decimal('x', __('X'));
        $form->decimal('y', __('Y'));
        $form->decimal('w', __('W'));
        $form->decimal('h', __('H'));
        $form->number('r', __('R'));
        $form->number('z', __('Z'));

        return $form;
    }
}
