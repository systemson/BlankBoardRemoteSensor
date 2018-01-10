<style>
@include('includes.css.bootstrap')
</style>

<div class="container">
  <div class="row">
    <table class="table">
      <tr>
        <td style="width: 50%;">
          <h4>Compañia Nacional de Agua</h4>
          <p>Dirección de la empresa</p>
          <p>Teléfono de la empresa</p>
        </td>
        <td class="bg-primary" style="width: 50%;">
          <h4 class="text-right">FACTURA</hr>
          <table style="width: 100%;">
            <tr>
              <td style="width: 50%;">
                <p class="text-right">Nro. de factura:</p>
                <p class="text-right">Tipo de Contrato:</p>
                <p class="text-right">Fecha de factura:</p>
                <p class="text-right">Fecha de vencimiento:</p>
              </td>
              <td style="width: 50%;">
                <p class="text-right">{{ $resource->id }}</p>
                <p class="text-right">{{ __('sensors.table.' . $resource->sensor->type) }}</p>
                <p class="text-right">{{ $resource->created_at->format('d/m/Y') }}</p>
                <p class="text-right">{{ $resource->created_at->addMonth()->format('d/m/Y') }}</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="width: 70%;">
          <table class="table">
            <tr>
              <td class="text-right" style="width: 30%;">
                <p>A nombre de:</p>
              </td>
              <td style="width: 70%;">
                {{ $resource->user->name }}<br>
                <b>Cédula:</b> {{ $resource->user->dni }}<br>
                <b>Teléfono:</b> {{ $resource->user->phone }}<br>
                <b>Dirección:</b> {{ $resource->user->address }}
              </td>
            </tr>
          </table>
        </td>
        <td style="width: 50%;"></td>
      </tr>
    </table>
    <table class="table table-striped">
      <thead>
        <tr class="info">
          <th>Descripción</th>
          <th>Consumo [mt3]</th>
          <th>Tasa [mt3/$]</th>
          <th>Monto</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Consumo de agua para el mes de {{ __('messages.month.' . $resource->month) }}</td>
          <td class="text-center">{{ number_format($resource->consumption, 2, '.', ',') }}</td>
          <td class="text-center">$ {{ config('rates.' . $resource->sensor->type) }}</td>
          <td class="text-center">$ {{ number_format($resource->payment, 2, '.', ',') }}</td>
        </tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
      </tbody>
    </table>
    <table class="table">
      <tr>
        <td style="width: 50%"></td>
        <td class="text-right" style="width: 50%">
          <p>Total a pagar: $ {{ number_format($resource->payment, 2, '.', ',') }}</p>
        </td>
      </tr>
    </table>
    <table class="table table-bordered">
      <tr>
        <td colspan="3"><b>Consumos anteriores:</b></td>
      </tr>
      <tr>
        @forelse ($latestInvoices as $invoice)
        <td style="width: 33%;">
          <p>Mes facturado: {{ __('messages.month.' . $invoice->month) }}<br>
          Consumo [mt3]: {{ number_format($invoice->consumption, 2, '.', ',') }}<br>
          Pagado: $ {{ number_format($invoice->payment, 2, '.', ',') }}
          {{ __('sensors.table.' . $invoice->sensor->type) }}
          </p>
        </td>
        @empty
          <td colspan="3">No tiene consumos anteriores</td>
        @endforelse
        @if (count($latestInvoices) == 2)
          <td style="width: 33%;"></td>
        @elseif (count($latestInvoices) == 1)
          <td style="width: 33%;"></td>
          <td style="width: 33%;"></td>
        @endif
      </tr>
    </table>
  </div>
</div>