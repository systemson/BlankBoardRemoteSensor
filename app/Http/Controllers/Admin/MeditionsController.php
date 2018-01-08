<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Medition as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MeditionsController extends Controller
{
    /**
     * The controller resource name.
     *
     * @var string
     */
    protected $name = 'meditions';

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