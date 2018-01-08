<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Invoice as Model;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * The controller resource name.
     *
     * @var string
     */
    protected $name = 'invoices';

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