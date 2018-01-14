@extends('layouts.admin')

@section('title', config('app.name', 'Laravel') . ' - ' . __($name . '.title'))

@section('content')
<!-- Content header (Page header) -->
  @include('includes.content-header', ['name' => $name, 'before' => [['name' => __('messages.admin-site'), 'route' => 'admin']]])
<!-- /. content header -->

<!-- Main content -->
<section class="content container-fluid">

  <div class="row">

    <div class="col-sm-12">
      @include('includes.alerts')
    </div>

    <div class="col-sm-12">
      <div class="box box-warning">

        <div class="box-header with-border">
          <h3 class="box-title">Filtros</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          {{ Form::open(['method' => 'GET', 'class' => "form-horizontal"]) }}
            <div class="form-group col-sm-4">
              {{ Form::label('sensor_id', 'Cód. Sensor', ['class' => 'control-label col-sm-6', 'onchange' => 'this.form.submit()']) }}
              <div class="col-sm-6">
                {{ Form::select('sensor_id', \App\Models\Sensor::where('user_id', auth()->id())->pluck('id','id')->prepend('Todos'), $filters['sensor_id'], ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>

            <div class="form-group col-sm-4">
              {{ Form::label('from', 'Desde', array('class' => 'control-label col-sm-6')) }}
              <div class="col-sm-6">
                {{ Form::select('from', config('months.all'), $filters['from'], ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>

            <div class="form-group col-sm-4">
              {{ Form::label('to', 'Hasta', array('class' => 'control-label col-sm-6')) }}
              <div class="col-sm-6">
                {{ Form::select('to', config('months.all'), $filters['to'], ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">{{ __($name . '.list', ['title' => __($name . '.title')]) }}</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div><!-- /. box header -->

        <div class="box-body no-padding">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th >{{ __($name . '.table.sensor') }}</th>
                <th>{{ __($name . '.table.medition') }}</th>
                <th>{{ __($name . '.table.rate') }}</th>
                <th>{{ __($name . '.table.price') }}</th>
                <th>{{ __($name . '.table.type') }}</th>
                <th>{{ __($name . '.table.date') }}</th>
              </tr>
            </thead>
            <tbody>

            @forelse ($resources as $resource)
              <tr>
                <td>{{ $resource->sensor->id }}</td>
                <td class="text-right">{{ number_format($resource->medition, 2, '.', ',') }}</td>
                <td class="text-right">{{ config('rates.' . $resource->sensor->type) }}&nbsp;$/m3</td>
                <td class="text-right">$&nbsp;{{ number_format($resource->medition * config('rates.' . $resource->sensor->type), 2, '.', ',') }}</td>
                <td>{{ __('sensors.table.' . $resource->sensor->type) }}</td>
                <td>{{ $resource->created_at->format('Y/m/d') }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="4">Tabla vacía</td>
              </tr>
              @endforelse

            </tbody>
          </table>
          <div class="col-sm-12">
            <div class="text-right">{{ $resources->links() }}</div>
          </div>
        </div><!-- /. box-body -->

      </div><!-- /. box -->
    </div><!-- /. col -->
  </div><!-- /. row -->

</section><!-- /. content -->
@stop

@section('scripts')

@stop
