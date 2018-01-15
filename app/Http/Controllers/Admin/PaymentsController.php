<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Medition as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

        $paid = Input::get('paid') ?? 0;
        $user_id = Input::get('user_id');
        $from = Input::get('from') ? Carbon::createFromFormat('Y-m', Input::get('from')) : null;
        $to = Input::get('to') ? Carbon::createFromFormat('Y-m', Input::get('to')) : null;

        $meditions = $this->model::where('created_at', '>', Carbon::now()->subMonths(11))
        ->where(function($query) use ($user_id, $paid, $from, $to)  {
            $query->where('paid', $paid);

            if($user_id) {
                $query->where('user_id', $user_id);
            }
            if($from) {
                $query->where('created_at', '>', $from);
            }
            if($to) {
                $query->where('created_at', '<', $to);
            }
        })
        ->get()
        ->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('Y-m');
        });

        $resources = [];
        foreach($meditions as $date => $meditions) {
            $resources[$date] = $meditions->groupBy('sensor_id');
        }

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.index')
        ->with('resources' , $resources)
        ->with('filters' , ['paid', $paid, 'user_id' => $user_id, 'from' => $from, 'to' => $to])
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