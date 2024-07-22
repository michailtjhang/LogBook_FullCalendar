@extends('template.appadmin')

@section('title', 'Organization')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Struktur Organisasi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('organization.create') }}" class="btn btn-primary mb-3 disabled"><i class="fas fa-plus"></i> Tambah</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Atasan</th>
                                    <th>Nama Karyawan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Atasan</th>
                                    <th>Nama Karyawan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($struktur as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->atasan->name }}</td>
                                        <td>{{ $row->bawahan->name }}</td>
                                        <td>
                                            <a href="{{ route('organization.edit', $row->id) }}" class="btn btn-warning btn-sm disabled">
                                                <span class="icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </a>
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

@endsection
