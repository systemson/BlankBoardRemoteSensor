@extends('layouts.admin')

@section('title', config('app.name', 'Laravel') . ' - ' .  __($name . '.title'))

@section('content')
<!-- Content header (Page header) -->
  @include ('includes.content-header', ['name' => $name, 'before' => [['name' => __('messages.admin-site'), 'route' => 'admin']], 'after' => [__('messages.new')]])
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
          <h3 class="box-title">{{ __($name . '.add', ['name' => trans_choice($name . '.name', 1)]) }}</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div><!-- /. box header -->

        <div class="box-body">
          <div class="col-sm-12">
            @include('includes.forms.invoices')
          <hr>
          </div>
          <div>
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="info">
                <th class="col-sm-6">Descripción</th>
                <th class="col-sm-2 text-center">Consumo [mt3]</th>
                <th class="col-sm-2 text-center">Tasa</th>
                <th class="col-sm-2 text-center">Monto</th>
              </tr>
            </thead>
            <tr>
              <td>Pago por consumo de agua por el mes de {{ __('messages.month.' . $month) }}</td>
              <td class="text-right">{{ number_format($meditions->sum('medition'), 2, '.', ',') }}</td>
              <td class="text-right">$ {{ config('rates.' . $meditions[0]->sensor->type) }}</td>
              <td class="text-right">$ {{ number_format($meditions->sum('medition') * config('rates.' . $meditions[0]->sensor->type), 2, '.', ',') }}</td>
            </tr>
          </table>
          </div>
          <div class="col-sm-12 text-right">
            <p>Total a pagar: $ {{ number_format($meditions->sum('medition') * config('rates.' . $meditions[0]->sensor->type), 2, '.', ',') }}</p>
          </div>
        </div><!-- /. box body -->

      </div><!-- /. box -->

    </div><!-- /. col -->
  </div><!-- /. row -->

</section><!-- /.content -->
@stop
