<!DOCTYPE html>
<html>
    @include('pdf.includes.head')
    <body>
        <header style="margin-bottom: 56pt">
            <div style="text-align: center">
                <h1>{{ $meta["name"] }}</h1>
                <h2>{{ Request::getHost() }}</h2>
            </div>
        </header>

        <main>
            <div style="margin-bottom: 16pt">
                <div
                    style="
                        display: inline-block;
                        width: 62%;
                        vertical-align: top;
                        margin-right: -4px;
                    "
                >
                    <h3>Kunde</h3>
                    <strong>{{ $order->name }}</strong
                    ><br />
                    {{ $order->street }}<br />
                    {{ $order->postcode->postcode}}
                    {{ $order->postcode->cities->first()->name}}
                    @if ($order->floor!=null)
                    <br />
                    <strong>Etage: </strong>{{ $order->floor }}
                    @endif
                    <br /><strong>Tel.: </strong>{{ $order->phone }}
                </div>

                <div
                    style="
                        display: inline-block;
                        width: 38%;
                        vertical-align: top;
                    "
                >
                    <h5>R E C H N U N G</h5>
                    <b>Datum: </b>
                    {{ $order->created_at->format('d.m.Y H:m:s') }}<br />
                    <b>Nummer: </b> #{{ $order->id }}<br />
                </div>
            </div>

            <div style="margin-bottom: 16pt">
                @if ($order->referenceOrder) Es wurden Änderungen an der
                Bestellung mit der Rechnung #{{ $order->referenceOrder->id }}
                vorgenommen. @endif
            </div>

            <div style="margin-bottom: 32pt">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="6%">#</th>
                            <th style="text-align: left" width="56%">
                                Produkt
                            </th>
                            <th width="10%">Preis</th>
                            <th width="9%">MwSt.</th>
                            <th width="9%">Menge</th>
                            <th width="10%">Gesamt</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $i=1 }}
                        @foreach ($order->positions as $position)
                        <tr>
                            <td style="text-align: center">{{ $i }}</td>
                            <td>
                                {{$position->variant->food->name}}
                                @foreach ($position->variant->variations as
                                $variation)
                                <br />{{$variation->name}}
                                @endforeach @foreach ($position->extras as
                                $extra)
                                <br />+ {{$extra->name}} @endforeach
                            </td>
                            <td style="text-align: center">
                                {{ number_format(($position->price)/100, 2, ',', ' ') }}
                                &euro;
                            </td>
                            <td style="text-align: center">
                                {{$position->variant()->first()->tax_rate}} %
                            </td>
                            <td style="text-align: center">
                                {{$position->quantity}}
                            </td>
                            <td>
                                {{number_format(($position->total)/100, 2, ',', ' ')}}
                                &euro;
                            </td>
                        </tr>
                        {{
                            +(+$i)
                        }}
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-bottom: 32pt">
                <div
                    style="
                        display: inline-block;
                        width: 62%;
                        margin-right: -4px;
                        vertical-align: top;
                    "
                >
                    @if ($order->notes!=null)
                    <h3>Anmerkungen</h3>
                    {{ $order->notes }}
                    @endif
                    <h3>Lieferung</h3>
                    @if ($order->delivery == -1) So schnell wie möglich! @else
                    {{sprintf("%02d", floor($order->delivery/60))}}
                    :{{sprintf("%02d", $order->delivery%60)}} Uhr @endif
                    <br />
                    {{ $order->method->name }}
                </div>

                <div
                    style="
                        display: inline-block;
                        width: 38%;
                        vertical-align: top;
                    "
                >
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><b>Zwischensumme</b></td>
                                <td width="37%">
                                    {{number_format(($order->netSubtotal)/100, 2, ',', ' ')}}
                                    &euro;
                                </td>
                            </tr>
                            @if ($order->rate)
                            <tr>
                                <td>
                                    <b> Lieferung </b>
                                </td>
                                <td>
                                    {{number_format(($order->rate->costs)/100, 2, ',', ' ')}}
                                    &euro;
                                </td>
                            </tr>
                            @endif @if ($order->refundRate)
                            <tr>
                                <td>
                                    <b> Lieferung Rückerstattung </b>
                                </td>
                                <td>
                                    {{number_format(((-1)*$order->refundRate->costs)/100, 2, ',', ' ')}}
                                    &euro;
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    <b> MwSt. </b>
                                </td>
                                <td>
                                    {{number_format(($order->subtotal - $order->netSubtotal)/100, 2, ',', ' ')}}
                                    &euro;
                                </td>
                            </tr>
                            <tr>
                                <td><b>Gesamt</b></td>
                                <td>
                                    <b
                                        >{{number_format(($order->total)/100, 2, ',', ' ')}}
                                        &euro;</b
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="text-align: center">
                <h6>Wir wünschen einen guten Apetitt!</h6>
            </div>
        </main>
        <footer>
            <p>
                {{ $meta["representative"] }} handelt im Namen von
                {{ $meta["name"] }}<br />
                {{ $meta["street"] }}, {{ $meta["city"] }}
                {{ $meta["country"] }}, Steuer-IdNr. {{ $meta["vat_id"] }}
            </p>
        </footer>
    </body>
</html>
