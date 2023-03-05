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
                    <div class="row">

                        {!! Form::open(['route' => $routePrefix. '.index', 'method' => 'GET']) !!}
                        <div class="input-group mt-3">
                            <div class="col mt-1 me-1">
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="col m-1">
                               {!! Form::selectRange('tahun', 2022, date('Y')+1, request('tahun'), ['class' => 'form-control'] )!!}
                            </div>
                            <div class="col m-1">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>NAMA</th>
                                    {{-- <th>JUMLAH</th> --}}
                                    <th>TANGGAL TAGIHAN</th>
                                    <th>STATUS</th>
                                    <th>TOTAL TAGIHAN</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nisn }}</td>
                                        <td>{{ $item->siswa->name }}</td>
                                        {{-- <td>{{ formatRupiah($item->jumlah, "IDR. ") }}</td> --}}
                                        {{-- <td>{{ $item->formatRupiah('jumlah_biaya') }}</td> --}}
                                        <td>{{ $item->tanggal_tagihan->format('d M Y') }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->tagihanDetail->sum('jumlah_biaya') }}</td>

                                        <td class="">
                                            {!! Form::open([
                                                'route' => [ $routePrefix . '.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Yakin ingin hapus data ?")',
                                                ]) !!}
                                                <a href="{{ route( $routePrefix . '.edit', $item->id) }}" class="btn btn-warning  btn-sm">Edit</a>

                                                    <a href="{{ route( $routePrefix . '.show', [
                                                        $item->id,
                                                        'siswa_id' => $item->siswa_id,
                                                        'bulan' => $item->tanggal_tagihan->format('m'),
                                                        'tahun' => $item->tanggal_tagihan->format('Y')
                                                         ]) }}" class="btn btn-info  btn-sm">
                                                     <i class="fas fa-eye"></i>
                                                    </a>
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
        </div>


@endsection
