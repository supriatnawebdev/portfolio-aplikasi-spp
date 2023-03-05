@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    {!! Form::model($model,
                        [
                        'route' => $route,
                        'method' => $method,
                        ]) !!}

                        <div class="row">
                            <div class="col-lg-6">
                                <label>Tagihan :</label>
                                @foreach ($spp as $item)
                                <div class="form-check mb-3">
                                    {!! Form::checkbox('spp_id[]', $item->id, null, [
                                        'class' => 'form-check-input',
                                        'id' => 'defaultCheck'.$loop->iteration,
                                        ]) !!}
                                    <label class="form-check-label" for="defaultCheck{{ $loop->iteration }}">
                                        {{ $item->nominal }}
                                    </label>
                                </div>
                                @endforeach

                                <div class="form-group mb-3">
                                  <label for="angkatan">Tagihan Untuk Angkatan</label>
                                  {!! Form::select('angkatan', $angkatan, null, ['class' => 'form-control',  'placeholder' => 'Pilih Angkatan']) !!}
                                  <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                                </div>
                                <div class="form-group mb-3">
                                  <label for="kelas">Tagihan Untuk Kelas</label>
                                  {!! Form::select('kelas', $kelas, null, ['class' => 'form-control', 'placeholder' => 'Pilih Kelas']) !!}
                                  <span class="text-danger">{{ $errors->first('kelas') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                 <div class="form-group mb-3">
                                    <label for="tanggal_tagihan">Tanggal Tagihan</label>
                                    {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-d'), ['class' => 'form-control','autofocus']) !!}
                                    <span class="text-danger">{{ $errors->first('tanggal_tagihan') }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                    {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo_tagihan ?? date('Y-m-d'), ['class' => 'form-control','autofocus',]) !!}
                                    <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo') }}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keterangan">Keterangan</label>
                                    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                 </div>
                            </div>
                        </div>





                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@endsection

  {{-- <div class="form-group mb-3">
                          <label for="spp_id">spp_id</label>
                          {!! Form::select('spp_id', $spp, null, ['class' => 'form-control', 'multiple' => true]) !!}
                          <span class="text-danger">{{ $errors->first('spp_id') }}</span>
                        </div> --}}
