@extends('layouts.frontend.app')
@section('title', 'Ploting Kapal')
@section('content')
    <div class="page-content page-home mt-1" data-aos="zoom-in" data-aos-delay="1000">
        <div class="text-center">
            <h3 id="dateTime"></h3>
        </div>
        <div class="table-kapal" style="width: 100%; position: absolute;bottom:-300px">
            @php
                $hitung = count($data);
            @endphp
            @if ($hitung == 0)
                <h1 class="text-center">Tidak Ada Jadwal</h1>
            @else
                <table border="0"
                    style="overflow-x: scroll; transform: scale(0.49) translateX(-50%); transform-origin: 0 0; position: absolute; left: 50%;"
                    id="table">
                    @php
                        $seen = [];
                        $date_range = array_reverse($date_range);
                    @endphp
                    @foreach ($date_range as $date)
                        <tr class="reverse">
                            <td width="100">{{ $date }}</td>
                            {{-- <td width="100"></td> --}}
                            @php
                                $datas = $data
                                    ->where('mulai', '<=', $date)
                                    ->where('selesai', '>=', $date)
                                    ->values();
                            @endphp

                            @for ($i = 1; $i <= 820; $i++)
                                @php
                                    $d = $datas->where('rangestart', $i)->first();
                                    unset($colspan);
                                    if ($d && !in_array($d->kapal_id, $seen)) {
                                        $panjang = data_get($d, 'kapal.panjang', null);
                                        $colspan = max(1, $d->rangestart) == $i;
                                        $seen[] = $d->kapal_id;
                                    }
                                @endphp
                                @if (isset($colspan))
                                    <td colspan="{{ $colspan ? $panjang ?? '' : '' }}" align="center"
                                        style="opacity: {{ !$d->status && $d->mulai < now() ? '0.3' : '1' }}">
                                        <span class="font-weight-bolder">{{ $d->kapal->nama }} ({{ $d->kapal->panjang }})</span>
                                        <br>
                                        <span class="font-weight-bold">
                                            BO : {{ $d->kapal->bongkar->jumlah }} {{ $d->kapal->bongkar->satuan == 'm' ? 'Ton / M3' : ($d->kapal->bongkar->satuan == 'u' ? 'Unit' : ($d->kapal->bongkar->satuan == 'b' ? 'Box' : '-')) }} {{ $d->kapal->bongkar->nama }} | MU : {{ $d->kapal->muat->jumlah }} {{ $d->kapal->muat->satuan == 'm' ? 'Ton / M3' : ($d->kapal->muat->satuan == 'u' ? 'Unit' : ($d->kapal->bongkar->satuan == 'b' ? 'Box' : '-')) }} {{ $d->kapal->muat->nama }}
                                        </span>
                                        <br>
                                        @php
                                            $mulai = Carbon\Carbon::parse($d->start)->translatedFormat('d/m H.i');
                                            $selesai = Carbon\Carbon::parse($d->finish)->translatedFormat('d/m H.i');
                                        @endphp
                                        <span class="font-weight-bold">
                                            ETB : {{ $mulai }} - {{ $selesai }}
                                        </span>
                                        <br>
                                        <span class="font-weight-bold text-danger">
                                            @if ($d->status && $d->info != null)
                                                {{ $d->info }}
                                            @elseif(!$d->status)
                                                Rencana
                                            @else
                                                Aktif
                                            @endif
                                        </span>
                                        <img width="100%" height="100"
                                            src="{{ $d && max(1, $d->rangestart) == $i ? asset($d->kapal->foto) : '' }}"
                                            alt="" onclick="showDetail({{ $d->id }})" style="cursor: pointer">
                                    </td>
                                    @php
                                        $i += $colspan ? $panjang - 1 : 0;
                                    @endphp
                                @else
                                    <td></td>
                                @endif
                            @endfor
                        </tr>
                    @endforeach
                    <tr class="reverse">
                        <td></td>
                        @for ($i = 0; $i <= 820; $i++)
                            <td>{{ $i % 20 == 0 ? $i : '' }}</td>
                            {{-- <td>{{ $i }}</td> --}}
                        @endfor
                    </tr>
                </table>
                {{-- <table border="0"
                style="
                    overflow-x: scroll; 
                    transform: scale(0.49) translateX(-50%); 
                    transform-origin: 0 0; 
                    position: absolute; left: 50%; bottom : -615px"
                    id="table2">
                    <tr class="reverse">
                        <td></td>
                        @for ($i = 0; $i <= 820; $i++)
                            <td style="font-weight:bold">{{ $i % 20 == 0 ? $i : '' }}</td>
                        @endfor
                    </tr>
                </table> --}}
            @endif
            
        </div>
    </div>
    @foreach ($data as $d)
        <div class="modal fade" id="modal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @php
                        $modalMulai = Carbon\Carbon::parse($d->start)->translatedFormat('l, d F Y H.i');
                        $modalSelesai = Carbon\Carbon::parse($d->finish)->translatedFormat('l, d F Y H.i');
                    @endphp
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="font-weight-bold">
                                    Detail Kapal
                                </h4>
                                <p><b>Nama Kapal :</b> {{ $d->kapal->nama }}</p>
                                <p><b>Panjang Kapal :</b> {{ $d->kapal->panjang }}</p>
                                
                            </div>
                            <div class="col-md-4">
                                <h4 class="font-weight-bold">
                                    Detail Sandar
                                </h4>
                                <p><b>Status Sandar :</b> {{ $d->status ? 'Aktif' : 'Rencana' }}</p>
                                <p><b>KD Meter :</b> {{ $d->rangestart }}</p>
                                <p><b>Mulai :</b> {{ $modalMulai }}</p>
                                <p><b>Selesai :</b> {{ $modalSelesai }}</p>
                            </div>
                            <div class="col-md-4">
                                <h4 class="font-weight-bold">
                                    Detail Bongkar Muat
                                </h4>
                                <p><b>Bongkar : </b> {{ $d->kapal->bongkar->jumlah }} {{ $d->kapal->bongkar->satuan == 'm' ? 'Ton / M3' : ($d->kapal->bongkar->satuan == 'u' ? 'Unit' : ($d->kapal->bongkar->satuan == 'b' ? 'Box' : '-')) }} {{ $d->kapal->bongkar->nama }}</p>
                                <p><b>Muat : </b> {{ $d->kapal->muat->jumlah }} {{ $d->kapal->muat->satuan == 'm' ? 'Ton / M3' : ($d->kapal->muat->satuan == 'u' ? 'Unit' : ($d->kapal->bongkar->satuan == 'b' ? 'Box' : '-')) }} {{ $d->kapal->muat->nama }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        function showDetail(sandar_id) {
            $('#modal' + sandar_id).modal('show');
        }
    </script>
    <script>
        function getLiveDate() {
            const now = new Date();
            const options = {
                year: "numeric",
                month: "long", // 'long' will display the full month name
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                second: "numeric",
                hour12: false,
            };
            const formatter = new Intl.DateTimeFormat("id-ID", options);
            const current = formatter.format(now);
            $("#dateTime").text(current.replaceAll('.', ':'));
        }

        setInterval(getLiveDate, 1000);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reverse = document.querySelectorAll('.reverse');
            reverse.forEach((r) => {
                const children = r.children;
                const childrenArray = Array.from(children);
                childrenArray.shift();
                childrenArray.reverse();
                childrenArray.forEach((c) => {
                    r.appendChild(c);
                });
            });

            var tbody = $('#table tbody');
            let rows = $('tr', tbody).get();
            const lastRow = rows.pop();
            rows.reverse();
            rows.push(lastRow);
            tbody.html(rows);

            var tbody2 = $('#table2 tbody2');
            let rows2 = $('tr', tbody2).get();
            const lastRow2 = rows2.pop();
            rows2.reverse();
            rows2.push(lastRow2);
            tbody2.html(rows2);
        });
    </script>
@endsection
