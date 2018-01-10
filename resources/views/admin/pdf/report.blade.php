@include('partials.w3cssStyle')

<h2 class="w3-center"><strong>Reporte</strong></h2>

<table style="width: 100%;">
    <tr>
        <td><strong>Cliente</strong></td>
        <td>{{$client->name}}</td>
    </tr>
    <tr>
        <td><strong>Cédula/RUC</strong></td>
        <td>{{$client->dni}}</td>
    </tr>
    <tr>
        <td><strong>Dirección</strong></td>
        <td>{{$client->address}}</td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>{{$client->email}}</td>
    </tr>
    <tr>
        <td><strong>Uso Predio</strong></td>
        <td>
            @if($client->measurer==='business')
                EMPRESARIAL
            @else
                RESIDENCIAL
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>Estado</strong></td>
        <td>
            @if($client->state==='active')
                ACTIVO
            @else
                INACTIVO
            @endif
        </td>
    </tr>
</table>

<br>
<h2 class="w3-center"><strong>HISTORIAL DE CONSUMOS</strong></h2>

<table class="w3-table-all" style="width: 100%">
    <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Medición [mt3]</th>
        <th>Valor</th>
    </tr>
    @foreach($meditions as $medition)
        <tr>
            <td>{{$medition->created_at->toDateString()}}</td>
            <td>{{$medition->created_at->toTimeString()}}</td>
            <td>{{$medition->medition}}</td>
            <td>$ {{round($medition->medition*$factor,2)}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2">Subtotal</td>
        <td>{{$consumption}}</td>
        <td>$ {{round($debt,2)}}</td>
    </tr>
    <tr>
        <td colspan="2">Iva 12%</td>
        <td></td>
        <td>$ {{round($debt*0.12,2)}}</td>
    </tr>
    <tr>
        <td colspan="2">Total</td>
        <td></td>
        <td>$ {{round($debt*1.12,2)}}</td>
    </tr>
</table>