<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Medition as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

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
     * Show the resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $sensor_id = Input::get('sensor_id');
        $from = Input::get('from') ? Carbon::createFromFormat('Y-m', Input::get('from')) : null;
        $to = Input::get('to') ? Carbon::createFromFormat('Y-m', Input::get('to')) : null;

        $meditions = $this->model::where('created_at', '>', Carbon::now()->subMonths(11))
        ->where('user_id', auth()->id())
        ->where('paid', 0)
        ->where(function($query) use ($sensor_id, $from, $to)  {
            if($sensor_id) {
                $query->where('sensor_id', $sensor_id);
            }
            if($from) {
                $query->where('created_at', '>', $from);
            }
            if($to) {
                $query->where('created_at', '<', $to);
            }
        })
        ->orderBy('created_at', 'DESC')
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
        ->with('filters' , ['sensor_id' => $sensor_id, 'from' => $from, 'to' => $to])
        ->with('name', $this->name);
    }

    public function daily()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $sensor_id = Input::get('sensor_id');
        $from = Input::get('from') ? Carbon::createFromFormat('Y-m', Input::get('from')) : null;
        $to = Input::get('to') ? Carbon::createFromFormat('Y-m', Input::get('to')) : null;

        /** Get the resources from the model */
        $resources = $this->model::where('created_at', '>', Carbon::now()->subYear())
        ->where('user_id', auth()->id())
        ->where(function($query) use ($sensor_id, $from, $to)  {
            if($sensor_id) {
                $query->where('sensor_id', $sensor_id);
            }
            if($from) {
                $query->where('created_at', '>', $from);
            }
            if($to) {
                $query->where('created_at', '<', $to);
            }
        })
        ->orderBy('created_at', 'DESC')
        ->paginate($this->paginate);

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.daily')
        ->with('resources' , $resources)
        ->with('filters' , ['sensor_id' => $sensor_id, 'from' => $from, 'to' => $to])
        ->with('name', $this->name);
    }

    public function monthly()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $sensor_id = Input::get('sensor_id');
        $from = Input::get('from') ? Carbon::createFromFormat('Y-m', Input::get('from')) : null;
        $to = Input::get('to') ? Carbon::createFromFormat('Y-m', Input::get('to')) : null;

        $meditions = $this->model::where('created_at', '>', Carbon::now()->subMonths(11))
        ->where('user_id', auth()->id())
        ->where(function($query) use ($sensor_id, $from, $to)  {
            if($sensor_id) {
                $query->where('sensor_id', $sensor_id);
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
        return view('admin.' . $this->name . '.monthly')
        ->with('resources' , $resources)
        ->with('filters' , ['sensor_id' => $sensor_id, 'from' => $from, 'to' => $to])
        ->with('name', $this->name);
    }

    public function graphs()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();;

        $groupBySensor = $this->model::where('created_at', '>', Carbon::now()->subYear())
        ->where('user_id', auth()->id())
        ->get()
        ->groupBy('sensor_id');

        foreach ($groupBySensor as $id => $sensor_data) {
            $groupByMonth[$id] = $sensor_data->groupBy(function($query) {
                return Carbon::parse($query->created_at)->format('F-y');
            });
        }

        $values = [];
        $months = [];
        foreach($groupByMonth as $sensor_id => $month ) {
            foreach($month as $group => $data) {
                $values[$sensor_id][] = $data->sum('medition');
                $months[$sensor_id][] = __('messages.month.' . Carbon::parse($group)->format('m'));

             }
         }

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.graphs')
        ->with('values', $values)
        ->with('months', $months)
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