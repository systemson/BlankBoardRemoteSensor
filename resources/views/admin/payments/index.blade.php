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

            <div class="form-group col-sm-6">
              {{ Form::label('user_id', 'Cédula', array('class' => 'control-label col-sm-6')) }}
              <div class="col-sm-6">
                {{ Form::select('user_id[]', \App\Models\User::where('dni', '<>', null)->pluck('dni','id'), $filters['user_id'], ['class' => 'control-form chosen-select col-sm-12', 'onchange' => 'this.form.submit()', 'multiple' => 'multiple']) }}
              </div>
            </div>

            <div class="form-group col-sm-6">
              {{ Form::label('paid', 'Estado', array('class' => 'control-label col-sm-6')) }}
              <div class="col-sm-6">
                {{ Form::select('paid', ['0' => 'Por Pagar', '1' => 'Pagado'],
                 0,
                  ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>

            <div class="form-group col-sm-6">
              {{ Form::label('from', 'Desde', array('class' => 'control-label col-sm-6')) }}
              <div class="col-sm-6">
                {{ Form::select('from', config('months.all'), $filters['from'], ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>

            <div class="form-group col-sm-6">
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
                <th>{{ __($name . '.table.month') }}</th>
                <th>{{ __($name . '.table.client') }}</th>
                <th>{{ __($name . '.table.dni') }}</th>
                <th>{{ __($name . '.table.sensor') }}</th>
                <th>{{ __($name . '.table.type') }}</th>
                <th>{{ __($name . '.table.medition') }}</th>
                <th>{{ __($name . '.table.price') }}</th>
                <th>{{ __($name . '.table.action') }}</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($resources as $date => $resource)
              @php $month = \Carbon\Carbon::parse($date)->format('m'); @endphp
              @foreach ($resource as $sensor => $invoice)
                @if ($date != \Carbon\Carbon::now()->format('Y-m'))
              <tr>
                <td>{{ __('messages.month.' . $month) }}</td>
                <?php $sensor = \App\Models\Sensor::where('id', $sensor)->first(); ?>
                <td>{{ $sensor->user->name }}</td>
                <td>{{ $sensor->user->dni }}</td>
                <td>{{ $sensor->id }}</td>
                <td>{{ __('sensors.table.' . $sensor->type) }}</td>
                <td>{{ number_format($invoice->sum('medition'), 2, '.', ',') }}</td>
                <td>{{ number_format($invoice->sum('medition') * config('rates.' . $sensor->type), 2, '.', ',') }}</td>
                @if ($invoice[0]->paid)
                  <td></td>
                @else
                  <td><a class="btn btn-success btn-sm" href="{{ route('invoices.create', [$sensor, $date]) }}" >Pagar</a></td>
                @endif
              </tr>
                @endif
              @endforeach
            @endforeach

            </tbody>
          </table>
        </div><!-- /. box-body -->

      </div><!-- /. box -->
    </div><!-- /. col -->
  </div><!-- /. row -->

</section><!-- /. content -->
@stop
