<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Invoice as Model;
use App\Models\Medition;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($user_id, $month)
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $meditions = Medition::where('user_id', $user_id)
        ->whereMonth('created_at', '=', Carbon::parse($month)->format('m'))
        ->where('paid', 0)
        ->get()
        ->groupBy('sensor_id');

        /** Show the form for creating a new resource. */
        return view('admin.' . $this->name . '.create')
        ->with('meditions', $meditions)
        ->with('name', $this->name);
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'index',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
        ];
    }
}