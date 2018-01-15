<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Sensor as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SensorsController extends Controller
{
    /**
     * The controller resource name.
     *
     * @var string
     */
    protected $name = 'sensors';

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

        $type = Input::get('type');
        $user_id = Input::get('user_id');

        /** Get the resources from the model */
        $resources = $this->model::
        where(function($query) use ($type, $user_id)  {
            if($type) {
                $query->where('type', $type);
            }
            if($user_id) {
                $query->where('user_id', $user_id);
            }
        })
        ->paginate($this->paginate);

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.index')
        ->with('resources' , $resources)
        ->with('filters' , ['type' => $type, 'user_id' => $user_id])
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