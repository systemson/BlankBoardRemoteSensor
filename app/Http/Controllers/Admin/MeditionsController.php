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

        /** Get the resources from the model */
        $resources = $this->model::where('created_at', '>', Carbon::now()->subYear())
        ->where('user_id', auth()->id())
        ->paginate($this->paginate);

        $groupByMonth = $this->model::where('created_at', '>', Carbon::now()->subYear())
        ->where('user_id', auth()->id())
        ->get()
        ->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('F-y');
        });

        $values = [];
        foreach($groupByMonth as $month) {
            $values[] = $month->sum('medition');
        }

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.index')
        ->with('resources' , $resources)
        ->with('byMonth', $groupByMonth)
        ->with('values', $values)
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