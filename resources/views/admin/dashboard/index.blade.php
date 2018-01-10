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
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div><!-- Box header -->

        <div class="box-body">
        <h2>Tips</h2>
        <ol style="font-size: 14pt;">
          <li>Prefiera remojar sus ollas para limpiarlas y no desperdiciar el agua mientras les quita la suciedad.</li>

          <li>Lave las frutas y las verduras en un recipiente con agua y no las limpie bajo el grifo.</li>

          <li>Arroje a una planta los cubos de hielo que se caen accidentalmente. A una mata también puede echar el agua que queda tras una cocción.</li>

          <li>No use el agua para descongelar los alimentos. Mejor emplee el refrigerador.</li>

          <li>Repare cualquier grifo que gotee y asegúrese de cerrar bien las llaves.</li>

          <li>Riegue con agua lluvia su jardín. Hágalo una vez por semana.</li>

          <li>Informe sobre tuberías rotas al propietario del bien o al proveedor de agua.</li>

          <li>En lugar de una manguera, utilice una escoba para limpiar la acera.</li>

          <li>Bañe a sus mascotas en un terreno que necesite riego.</li>

          <li>Evite juguetes que requieren un flujo constante del líquido, como las pistolas de agua.</li>

          <li>Opte por el lavado ecológico para su vehículo, que se puede realizar con productos que ofrece el mercado para limpiar y brillar el carro, sin usar una gota de agua. También puede prescindir de la manguera y usar un balde con agua.</li>

          <li>Al lavar ropa revise que el nivel del agua corresponda al tamaño de las prendas.</li>

          <li>Cierre la llave del lavamanos mientras se cepilla los dientes o se baña su rostro.</li>
          <li>Instale un sanitario de bajo volumen de agua. Si su inodoro es antiguo, adáptele un dispositivo de ahorro en la cisterna que permite descargas de agua parciales y totales.</li>
        </ol>
        </div><!-- /. box body -->

      </div><!-- /. box -->

    </div><!-- /. col -->
  </div><!-- /. row -->

</section><!-- /.content -->
@stop
