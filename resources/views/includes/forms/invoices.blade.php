{{ Form::open(array('url' => route($name . '.store'), 'method' => 'POST', 'class' => 'form-horizontal')) }}

  <div class="col-sm-12 text-right">
      {{ Form::submit('Pagar', array('class' => 'btn btn-success')) }}
      <button name="print" class="btn btn-primary" type="input" value="1"><i class="fa fa-print"></i>&nbsp;Pagar e Imprimir</button>
  </div>

    {{ Form::hidden('user_id', $sensor->user->id) }}
    {{ Form::hidden('sensor_id', $sensor->id) }}
    {{ Form::hidden('month', $month) }}
    {{ Form::hidden('year', $year) }}
    {{ Form::hidden('consumption', $meditions->sum('medition')) }}
    {{ Form::hidden('payment', $meditions->sum('medition') * config('rates.' . $meditions[0]->sensor->type)) }}

{{ Form::close() }}

