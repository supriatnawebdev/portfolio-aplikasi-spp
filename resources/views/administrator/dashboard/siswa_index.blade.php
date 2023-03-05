@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    {{-- {!! Form::open(['route' => $routePrefix. '.index', 'method' => 'GET']) !!}
                    <div class="input-group mt-3">
                        <input name="q" type="text" class="form-control" placeholder="Cari Nama Siswa" aria-label="Cari Nama" aria-describedby="button-addon2" value="{{ request('q') }}">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                      </div>
                    {!! Form::close() !!} --}}
                    <div class="container text-center py-0 mt-2">
                        @include('flash::message')
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th width="8%" >Angkatan</th>
                                    {{-- <th>CREATED BY</th> --}}
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->kelas->nama_kelas }}</td>
                                        <td>{{ $item->kelas->kompetensi_keahlian }}</td>
                                        <td>{{ $item->angkatan }}</td>
                                        {{-- <td>{{ $item->user->name }}</td> --}}
                                        <td class="">
                                            {!! Form::open([
                                                'route' => [ $routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin ingin hapus data ?")',
                                                ]) !!}
                                                <a href="{{ route( $routePrefix . '.edit', $item->id) }}" class="btn btn-warning  btn-sm  mr-1">
                                                    <i class="fas fa-edit"></i></</a>
                                                <a href="{{ route( $routePrefix . '.show', $item->id) }}" class="btn btn-info  btn-sm">
                                                <i class="fas fa-eye"></i></a>
                                                {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                                           {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $models->links() !!}
                    </div>
                </div>
            </div>
        <script>
            $('#flash-overlay-modal').modal();
        </script>
        </div>





@endsection
