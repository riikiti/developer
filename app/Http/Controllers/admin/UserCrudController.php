<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use ListOperation;
    public function setup()
    {
        $this->crud->setModel(User::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('Пользователя', 'Пользователи');
    }


    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        $this->crud->column('id')->label('ID');
        $this->crud->column('name')->label('Имя');
        $this->crud->column('username')->label('Логин');
        $this->crud->column('email')->label('Почта');
        $this->crud->column('banned')->label('Статус бана');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('name')->label('Наименование');
        $this->crud->field('username')->label('Логин');
        $this->crud->field('email')->label('Почта');
        $this->crud->field('banned')->label('Статус бана');
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
