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
              {{ Form::label('type', 'Tipo', ['class' => 'control-label col-sm-6', 'onchange' => 'this.form.submit()']) }}
              <div class="col-sm-6">
                {{ Form::select('type', [0 => 'Seleccione', 'home' => 'Hogar', 'bussiness' => 'Empresa'], $filters['type'], ['class' => 'control-form', 'onchange' => 'this.form.submit()']) }}
              </div>
            </div>

            <div class="form-group col-sm-6">
              {{ Form::label('user_id', 'DNI', array('class' => 'control-label col-sm-4')) }}
              <div class="col-sm-8">
                {{ Form::select('user_id', \App\Models\User::where('dni', '<>', null)->pluck('dni','id'), $filters['user_id'], ['class' => 'control-form chosen-select', 'onchange' => 'this.form.submit()', 'multiple' => 'multiple']) }}
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
            <a class="{{ __('messages.btn.new.class') }}" href="{{ route($name . '.create') }}" >            <i class="fa fa-plus-circle"></i>
              {{ __('messages.btn.new.name') }}
            </a>
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
                <th class="col-sm-12">{{ __($name . '.table.name') }}</th>
                <th>{{ __($name . '.table.dni') }}</th>
                <th>{{ __($name . '.table.user') }}</th>
                <th>{{ __($name . '.table.type') }}</th>
                <th class="text-center">{{ __($name . '.table.action') }}</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($resources as $resource)
              <tr>
                <td>{{ $resource->id }}</td>
                <td><a href="{{ route($name . '.edit', $resource->id) }}">{{ $resource->name }}</a></td>
                <td>{{ $resource->user->dni }}</td>
                <td>{{ $resource->user->name }}</td>
                <td>{{ __($name . '.table.' . $resource->type) }}</td>
                <td class="text-nowrap">
                    {{ Form::open(['method' => 'DELETE','route' => [$name . '.destroy', $resource->id]]) }}
                      {{ Form::button( __('messages.action.trash'), array(
                        'type' => 'submit',
                        'class'=> 'btn-danger btn-xs',
                        'onclick'=>'return confirm("' . __($name . '.confirm-delete') . '")'
                      )) }}
                    {{ Form::close() }}
                </td>
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
