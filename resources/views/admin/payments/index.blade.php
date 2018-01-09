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
                <th>{{ __($name . '.table.cliente') }}</th>
                <th>{{ __($name . '.table.dni') }}</th>
                <th>{{ __($name . '.table.medition') }}</th>
                <th>{{ __($name . '.table.price') }}</th>
                <th>{{ __($name . '.table.action') }}</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($resources as $month => $resource)
              @foreach ($resource as $user => $invoice)
              <tr>
                <td>{{ $month }}</td>
                <?php $user = \App\Models\User::where('id', $user)->first(); ?>
                <td>{{ $user->name }}</td>
                <td>{{ $user->dni }}</td>
                <td>{{ number_format($invoice->sum('medition'), 2, '.', ',') }}</td>
                <td>{{ number_format($invoice->sum('medition') * 0.1, 2, '.', ',') }}</td>
                <td><a class="btn btn-success btn-sm" href="{{ route('invoices.create', [$user, $month]) }}" >Pagar</a></td>
              </tr>
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
