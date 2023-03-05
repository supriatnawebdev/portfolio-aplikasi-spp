@extends('layouts.admin')

@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    {{-- <a href="{{ route($routePrefix . '.index') }}" class="btn btn-primary btn-sm ">Kembali</a> --}}
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="{{ \Storage::url($model->foto ?? 'images/no-image.jpg') }}" width="150">
                            </div>

                            <div class="col-lg-4">
                                <table class="table table-responsive table-border-bottom">
                                    <thead>
                                        <tr>
                                            <td width="15%">ID</td>
                                            <td>: {{ $model->id }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">NAMA</td>
                                            <td>: {{ $model->name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">NISN</td>
                                            <td>: {{ $model->nisn }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%">NIS</td>
                                            <td>: {{ $model->nis }}</td>
                                        </tr>

                                        <tr>
                                            <td width="15%">KELAS</td>
                                            <td>: {{ $model->kelas->nama_kelas }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%">JURUSAN</td>
                                            <td>: {{ $model->kelas->kompetensi_keahlian }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <table class="table table-responsive table-border-bottom">
                                    <thead>
                                        <tr>
                                            <td width="19%">No Hp</td>
                                            <td>: {{ $model->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td width="19%">Email</td>
                                            <td>: {{ $model->email }}</td>
                                        </tr>
                                        <tr>
                                            <td width="19%">Alamat</td>
                                            <td>: {{ $model->alamat }}</td>
                                        </tr>

                                        <tr>
                                            <td width="19%">Ceated By</td>
                                            <td>: {{ $model->user->name }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


@endsection
