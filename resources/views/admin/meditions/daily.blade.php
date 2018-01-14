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
                <th>{{ __($name . '.table.dni') }}</th>
                <th class="col-sm-12">{{ __($name . '.table.client') }}</th>
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
                <td>{{ $resource->user->dni }}</td>
                <td>{{ $resource->user->name }}</td>
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
