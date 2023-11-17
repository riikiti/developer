<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FavoritesRequest;
use App\Models\Favorites;
use App\Models\Movie;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FavoritesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FavoritesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Favorites::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/favorites');
        CRUD::setEntityNameStrings('favorites', 'favorites');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'user',
            'label' => 'Пользователи',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->user()->pluck('name')[0];
            }
        ]);

        $this->crud->addColumn([
            'name' => 'movie',
            'label' => 'Фильмы',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->movie()->pluck('name')[0];
            }
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'label'     => "User",
            'type'      => 'select',
            'name'      => 'user_id',
            'entity'    => 'user',
            'model'     => User::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label'     => "Movie",
            'type'      => 'select',
            'name'      => 'movie_id',
            'entity'    => 'user',
            'model'     => Movie::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
