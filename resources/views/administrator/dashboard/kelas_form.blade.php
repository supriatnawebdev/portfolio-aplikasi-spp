@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    {!! Form::model($model,
                        [
                        'route' => $route,
                        'method' => $method,
                        ]) !!}

                        <div class="form-group mb-3">
                          <label for="nama_kelas">Nama Kelas</label>
                          {!! Form::text('nama_kelas', null, ['class' => 'form-control','autofocus',]) !!}
                          <span class="text-danger">{{ $errors->first('nama_kelas') }}</span>
                        </div>
                        <div class="form-group mb-3">
                          <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                          {!! Form::text('kompetensi_keahlian', null, ['class' => 'form-control','autofocus',]) !!}
                          <span class="text-danger">{{ $errors->first('kompetensi_keahlian') }}</span>
                        </div>


                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
