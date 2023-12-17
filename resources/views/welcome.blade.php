@extends('layouts.frontend.app')
@section('title', 'Ploting Kapal')
@section('css')
    @vite('resources/css/app.css')
@endsection
@section('content')
    <div class="page-content page-home mt-1" data-aos="zoom-in" data-aos-delay="1000">
        <div class="text-center">
            <h3 id="dateTime"></h3>
        </div>
        <div class="table-kapal" style="width: 100%;">
            {{-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12"> --}}
            <table border="1"
                style="overflow-x: scroll; transform: scale(0.49) translateX(-50%); transform-origin: 0 0; position: absolute; left: 50%;"
                id="table">
                @php
                    $seen = [];
                    $date_range = array_reverse($date_range);
                @endphp
                @foreach ($date_range as $date)
                    <tr class="reverse">
                        <td width="100">{{ $date }}</td>
                        <td width="100"></td>
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
                                    <p>{{ $d->kapal->nama }}</p>
                                    <p>{{ $d->kapal->panjang }}</p>
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
                    @for ($i = 1; $i <= 820; $i++)
                        <td>{{ $i % 20 == 0 ? $i : '' }}</td>
                        {{-- <td>{{ $i }}</td> --}}
                    @endfor
                </tr>
            </table>
            {{-- </div>
                </div>
            </div> --}}
        </div>

    </div>

    @foreach ($data as $d)
        <div class="modal fade" id="modal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail Kapal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $d->kapal->nama }}
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
    @vite('resources/js/app.js')
    <script>
        $(document).ready(function() {
            Echo.channel(`kapal-channel`)
                .listen('KapalEvent', (e) => {
                    location.reload()
                });
        });

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
            rows.push(lastRow)
            tbody.html(rows);
        });
    </script>
@endsection
