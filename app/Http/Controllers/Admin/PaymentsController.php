<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Medition as Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * Show the resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $meditions = $this->model::where('created_at', '>', Carbon::now()->subMonths(11))
        ->where('paid', 0)
        ->get()
        ->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('F');
        });

        $resources = [];
        foreach($meditions as $month => $meditions) {
            $resources[$month] = $meditions->groupBy('user_id');
        }

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.index')
        ->with('resources' , $resources)
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