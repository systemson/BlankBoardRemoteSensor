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
                <th>{{ __($name . '.table.id') }}</th>
                <th>{{ __($name . '.table.period') }}</th>
                <th>{{ __($name . '.table.sensor') }}</th>
                <th>{{ __($name . '.table.type') }}</th>
                <th>{{ __($name . '.table.consumption') }}</th>
                <th>{{ __($name . '.table.paid') }}</th>
                <th>{{ __($name . '.table.paid_at') }}</th>
                <th class="text-center">{{ __($name . '.table.action') }}</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($resources as $resource)
              <tr>
                <td>{{ $resource->id }}</td>
                <td>{{ __('messages.month.' . $resource->month) . '-' . $resource->year }}</td>
                <td>{{ $resource->sensor->id }}</td>
                <td>{{ __('sensors.table.' . $resource->sensor->type) }}</td>
                <td class="text-right">{{ number_format($resource->consumption, 2, '.', ',') }}</td>
                <td class="text-right">$ {{ number_format($resource->payment, 2, '.', ',') }}</td>
                <td class="text-center">{{ $resource->created_at->format('Y-m-d') }}</td>
                <td class="text-center"><a class="btn btn-primary btn-xs" href="{{ route($name . '.show', [$resource->id]) }}" ><i class="fa fa-download"></i></a></td>
              </tr>
            @endforeach
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
