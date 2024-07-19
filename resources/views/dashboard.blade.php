@extends('template.appadmin')

@section('title', 'Dashboard')

@section('content')

{{-- jabatan staff tdk bisa melihat --}}
@if (Auth::user()->jabatan != 'staff')

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">LogBook Karyawan Staff</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Topik Harian</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Topik Harian</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($logbook as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->user_name}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>{{$row->date}}</td>
                                    <td>
                                        @if ($row->status == 'Disetujui' || $row->status == 'Ditolak')
                                            Disetujui
                                        @else
                                            <button type="button"  class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter{{$row->id}}">
                                                Ubah Status
                                            </button>
                                        @endif
                                        {{-- Modal --}}
                                        <div class="modal fade" id="exampleModalCenter{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Pengubahan Status LogBook</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('dash/store', $row->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <fieldset class="row mb-3">
                                                                <div class="col-sm-10">
                                                                @php
                                                                    $status = ['Disetujui', 'Ditolak'];
                                                                @endphp
                                                                @foreach ($status as $items)
                                                                @php $sel = ($items == $row->status) ? 'checked' : ''; @endphp
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                    <input class="form-check-input" type="radio" name="status" id="gridRadios_{{$loop->iteration}}" value="{{$items}}" {{$sel}}>
                                                                    <label class="form-check-label" for="gridRadios_{{$loop->iteration}}">
                                                                        {{$items}}
                                                                    </label>
                                                                    </div>
                                                                @endforeach
                                                                </div>
                                                            </fieldset>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
        <div id='calendar'></div>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js'></script>

    {{-- script fullcalendar --}}
    <script>

        const modal = $('#modal-action')
  
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('logbook.dashlist') }}`,
          });
          calendar.render();
        });
  
      </script>
@else

<div class="row justify-content-center">
    <div class="col center">
        <h1 class="h1 mb-0 text-gray-800 font-weight-bold center">No Found</h1>
        <p class="mb-0 text-gray-800 font-weight-bold center">404</p>
        <a href="{{ url('logbook') }}" class="btn btn-primary center"> Kembali ke LogBook</a>
    </div>
</div>

@endif

@endsection