{{ Form::open(array('url' => route($name . '.store'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

  <div class="col-sm-12 text-right">
    {{ Form::submit('Realizar Cobro', array('class' => 'btn btn-success')) }}
  </div>

    {{ Form::hidden('user_id', $sensor->user->id) }}
    {{ Form::hidden('sensor_id', $sensor->id) }}
    {{ Form::hidden('month', $month) }}
    {{ Form::hidden('year', $year) }}
    {{ Form::hidden('consumption', $meditions->sum('medition')) }}
    {{ Form::hidden('payment', $meditions->sum('medition') * config('rates.' . $meditions[0]->sensor->type)) }}

{{ Form::close() }}

