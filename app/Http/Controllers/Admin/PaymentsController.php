<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Permission as Model;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * The controller resource name.
     *
     * @var string
     */
    protected $name = 'payments';

    /**
     * Model class.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            //
        ];
    }
}