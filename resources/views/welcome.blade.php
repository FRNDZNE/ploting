@extends('layouts.frontend.app')
@section('title','Ploting Kapal')
@section('css')
    @vite('resources/css/app.css')
@endsection
@section('content')
    <div
      class="page-content page-home mt-1"
      data-aos="zoom-in"
      data-aos-delay="1000">
      <div class="text-center">
        <h3 id="dateTime"></h3>
      </div>
      <div class="table-kapal" style="width: 100%;">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <table border="1" style="overflow-x: scroll">
                  @foreach ($date_range as $date)
                    <tr class="reverse">
                      {{-- <td width="100">{{ $date }}</td> --}}
                      <td width="100"></td>
                      @for ($i = 1; $i <= 820; $i++)
                          @php
                              $d = $data->where('mulai' , '>=', $date)->first();
                              $panjang = data_get($d, 'kapal.panjang', null);
                              $colspan = $d && max(1, $d->rangestart) == $i;
                          @endphp

                          <td colspan="{{ $colspan ? $panjang ?? '' : '' }}" align="center">
                              @if ($colspan)
                                  <p>{{ $d->kapal->nama }}</p>
                                  <p>{{ $d->kapal->panjang }}</p>
                                  <img width="100%" height="100"
                                      src="{{ $d && max(1, $d->rangestart) == $i ? asset($d->kapal->foto) : '' }}"
                                      alt="">
                              @else
                                  {{-- {{ $i }} --}}
                              @endif
                          </td>
                          @php
                              $i += $colspan ? $panjang - 1 : 0;
                          @endphp
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
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
  @vite('resources/js/app.js')
  <script>
    $(document).ready(function(){
      Echo.channel(`kapal-channel`)
      .listen('KapalEvent', (e) => {
        // console.log('Test Event');
        console.log(e);
      });
    });
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
      $("#dateTime").text(current);
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
    });
  </script>
@endsection