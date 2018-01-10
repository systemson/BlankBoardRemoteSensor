<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ResourceController as Controller;
use App\Models\Invoice as Model;
use App\Models\Sensor;
use App\Models\Medition;
use Illuminate\Support\Facades\Input;
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
     * Show the resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        /** Get the resources from the model */
        $resources = $this->model::where('user_id', \Auth::id())
        ->paginate($this->paginate);

        /** Display a listing of the resources */
        return view('admin.' . $this->name . '.index')
        ->with('resources' , $resources)
        ->with('name', $this->name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($sensor_id, $date)
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        $meditions = Medition::where('sensor_id', $sensor_id)
        ->whereMonth('created_at', '=', Carbon::parse($date)->format('m'))
        ->whereYear('created_at', '=', Carbon::parse($date)->format('Y'))
        //->where('paid', 0)
        ->get()
        ->groupBy('sensor_id')
        ->first();

        $sensor = Sensor::find($sensor_id);

        /** Show the form for creating a new resource. */
        return view('admin.' . $this->name . '.create')
        ->with('meditions', $meditions)
        ->with('sensor', $sensor)
        ->with('month', Carbon::parse($date)->format('m'))
        ->with('year', Carbon::parse($date)->format('Y'))
        ->with('name', $this->name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        if(method_exists($this, 'storeValidations')) {
            $request->validate($this->storeValidations());
        }

        /** Create a new resource */
        $resource = $this->model::create(Input::all());

        $meditions = Medition::where('sensor_id', Input::get('sensor_id'))
        ->whereMonth('created_at', '=', Input::get('month'))
        ->whereYear('created_at', '=', Input::get('year'))
        ->get();

        foreach ($meditions as $medition) {
            $medition->update(['paid' => true, 'invoice_id' => $resource->id]);
        }

        /** Redirect to newly created resource page */
        return redirect()
        ->route('invoices.show', [$resource->id])
        ->with('success', $this->name . '.resource-created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id the specified resource id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** Check if logged in user is authorized to make this request */
        $this->authorizeAction();

        /** Get the specified resource */
        $resource = $this->model::findOrFail($id);

        $latestInvoices = $this->model::where('id', '<>', $resource->id)
        ->where('sensor_id', $resource->sensor->id)
        ->orderBy('year', 'DESC')
        ->orderBy('month', 'DESC')
        ->take(3)
        ->get();

        $paper_size=array(0,0,110,229);

        $pdf = \App::make('dompdf.wrapper');
        return $pdf->loadView('admin.pdf.invoice',[
            'resource' => $resource,
            'latestInvoices' => $latestInvoices,
        ])->stream();
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