@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-header">DATA TAGIHAN SPP  {{ strtoupper($periode) }}</h5>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td rowspan="8" width="100"><img src="{{ \Storage::url($siswa->foto) }}" alt="{{ $siswa->name }}" width="200"></td>
                                </tr>
                                <tr>
                                    <td width="50">NISN:</td>
                                    <td>{{ $siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA:</td>
                                    <td>{{ $siswa->name }}</td>
                                </tr>
                            </table>
                            {{-- <div class="mt-2">
                                <a href="{{ route('kartuspp.index', [
                                    'siswa_id' => $siswa->id,
                                    'tahun' => request('tahun')
                                ]) }}" class="btn btn-sm btn-primary" target="blank">
                                    <i class="fa fa-file me-1"></i>

                                    Kartu tagihan {{ request('tahun') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <h5 class="card-header mb-1  pb-0">DATA TAGIHAN  {{ strtoupper($periode) }}</h5>
                        <div class="card-body mb-0 pb-0">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tagihan</th>
                                        <th>Jumlah Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tagihan->tagihanDetail  as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_biaya }}</td>
                                        <td>{{ formatRupiah($item->jumlah_biaya) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>{{ formatRupiah($tagihan->tagihanDetail->sum('jumlah_biaya')) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h5 class="card-header  pb-0 pt-3">FORM PEMBAYARAN</h5>
                            <div class="card-body">
                                {!! Form::model($model, ['route' => 'pembayaran.store', 'method' => 'POST']) !!}
                                {!! Form::hidden('tagihan_id', $tagihan->id, []) !!}
                                {!! Form::hidden('siswa_id', request('siswa_id'), []) !!}
                                <div class="form-group mb-2">
                                    <label for="tanggal_bayar" class="form-label">Tanggal bayar</label>
                                    {!! Form::date('tanggal_bayar',$model->tanggal_bayar ?? \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                </div>
                                <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                                <div class="form-group mb-2">
                                    <label for="jumlah_dibayar" class="form-label">Jumlah Yang Dibayarkan</label>
                                {!! Form::text('jumlah_dibayar', null, ['class' => 'form-control rupiah']) !!}
                                </div>
                                <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                                {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary mt-2']) !!}
                                {!! Form::close() !!}
                            </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        {{-- data pembayaran --}}
                        <div>
                            <h5 class="card-header  pb-0 mb-1">DATA PEMBAYARAN</h5>
                            <div class="card-body pb-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>TANGGAL</th>
                                            <th>JUMLAH</th>
                                            <th>METODE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihan->pembayaran as $item)
                                        <tr>
                                            {{-- <td>
                                                <a href="{{ route('kwitansipembayaran.show', $item->id) }}" target="blank"><i class="fa fa-print"></i></a>
                                            </td> --}}
                                            <td></td>
                                            <td>{{ $item->tanggal_bayar->translatedFormat('d/m/Y') }}</td>
                                            <td>{{ formatRupiah($item->jumlah_dibayar) }}</td>
                                            <td>{{ $item->metode_pembayaran }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total Pembayaran</td>
                                            <td>{{formatRupiah($tagihan->pembayaran->sum('jumlah_dibayar'))}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <h5 class="mt-2 card-header pt-0">STATUS PEMBAYARAN : {{ strtoupper($tagihan->status) }}</h5>
                        </div>
                        {{-- end data pembayaran --}}
                    </div>
                </div>
            </div>
        </div>


@endsection
