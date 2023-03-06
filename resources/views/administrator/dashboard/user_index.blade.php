
@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Petugas</div>

                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->level }}</td>
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
                        {{-- {!! $models->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>





@endsection

