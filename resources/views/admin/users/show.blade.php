@extends('layouts.admin')

@section('title', config('app.name', 'Laravel') . ' - ' . __($name . '.title'))

@section('content')
<!-- Content header (Page header) -->
  @include('includes.content-header', ['name' => $name, 'before' => [['name' => __('messages.admin-site'), 'route' => 'admin'], __($name . '.parent')], 'after' => [__('users.show')]])
<!-- /. content header -->

<!-- Main content -->
<section class="content container-fluid">

  <div class="row">

    <div class="col-sm-12">
      @include('includes.alerts')
    </div>

    <div class="col-sm-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Datos del Usuario</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <h3 class="text-center">{{ $resource->name }} <small>Cédula {{ $resource->dni }}</small></h3>
          <hr>
          <div class="col-sm-8">
            <div class="col-sm-12">
              <div class="col-sm-4 text-right"><b>Email:</b></div>
              <div class="col-sm-8">{{ $resource->email}}</div>
            </div>
            <div class="col-sm-12">
              <div class="col-sm-4 text-right"><b>Teléfono:</b></div>
              <div class="col-sm-8">{{ $resource->phone}}</div>
            </div>
            <div class="col-sm-12">
              <div class="col-sm-4 text-right"><b>Dirección:</b></div>
              <div class="col-sm-8">{{ $resource->address}}</div>
            </div>
            <div class="col-sm-12">
              <div class="col-sm-4 text-right"><b>Cliente Desde:</b></div>
              <div class="col-sm-8">{{ $resource->created_at->format('d-m-Y') }}</div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="col-sm-12">
              <div class="col-sm-8 text-right"><b>Consumo este Mes:</b></div>
              <div class="col-sm-4">{{ number_format($resource->monthlyConsumption(), 2, '.', ',') }}</div>
            </div>
            <div class="col-sm-12">
              <div class="col-sm-8 text-right"><b>Consumo Anual:</b></div>
              <div class="col-sm-4">{{ number_format($resource->yearlyConsumption(), 2, '.', ',') }}</div>
            </div>
            <div class="col-sm-12">
              <div class="col-sm-8 text-right"><b>Consumo Promedio Mensual:</b></div>
              <div class="col-sm-4">{{ number_format($resource->yearlyConsumption() / 12, 2, '.', ',') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /. row -->

</section><!-- /.content -->
@stop
