@extends('layouts.admin_siswa')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('siswa')->user()->username }}</span>
@endsection
@section('content')


<div class="col-lg-12">
    <div class="card-header">{{ $title }}</div>
        <div class="card-body">

            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>NAMA</th>
                        {{-- <th>JUMLAH</th> --}}
                        <th>TANGGAL TAGIHAN</th>
                        <th>TOTAL TAGIHAN</th>
                        <th>JUMLAH PEMBAYARAN</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tagihan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->siswa->nisn }}</td>
                            <td>{{ $item->siswa->name }}</td>

                            <td>{{ $item->tanggal_tagihan->format('d M Y') }}</td>

                            @foreach ($item->tagihanDetail as $detail )
                                <td>{{formatRupiah($detail->jumlah_biaya)}}</td>
                            @endforeach

                         <td>
                            @foreach ($item->pembayaran as $pembayaran )
                                    <ul>
                                        <li>
                                            {{formatRupiah($pembayaran->jumlah_dibayar)}}
                                        </li>
                                    </ul>

                            @endforeach

                        </td>

                            <td>{{ $item->status }}</td>


                        </tr>
                    @empty
                    <tr>
                        <td colspan="4">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

</div>




@endsection
