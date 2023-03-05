@extends('layouts.admin')
@section('profilname')
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
@endsection
@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>


                <div class="card-body">
                    {!! Form::model($model, ['route' => $route,
                        'method' => $method,
                        'files' => true]) !!}

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    {!! Form::text('name', null, ['class' => 'form-control','autofocus']) !!}
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nisn">Nisn</label>
                                    {!! Form::number('nisn', null, ['class' => 'form-control','autofocus']) !!}
                                    <span class="text-danger">{{ $errors->first('nisn') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="nis">Nis</label>
                                  {!! Form::number('nis', null, ['class' => 'form-control','autofocus']) !!}
                                  <span class="text-danger">{{ $errors->first('nis') }}</span>
                                </div>

                                <div class="form-group mb-4">
                                  <label for="kelas_id">Kelas</label>
                                  {!! Form::select('kelas_id', $kelas, null, [
                                      'class' => 'form-control select2',
                                      'placeholder' => 'Pilih Kelas']) !!}
                                  <span class="text-danger">{{ $errors->first('kelas_id') }}</span>
                                </div>

                                <div class="form-group  mb-1">
                                    <label for="foto">Foto <i>(Format: jpg, jpeg, png Ukuran Maks:5MB)</i></label>
                                    <div class="custom-file">
                                        <label for="foto" class="custom-file-label">Pilih Gambar</label>
                                        {!! Form::file('foto', ['class' => 'custom-file-input', 'accept' => 'image/*']) !!}
                                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                                    </div>
                                </div>

                                <div class="d-block mb-3">
                                    {{-- <label for="currentImage" class="form-label d-block">currentImage</label> --}}
                                    @if ($model->foto != null)
                                    <div class="mt-3">
                                        <img src="{{ \Storage::url($model->foto) }}" alt="" width="200">
                                    </div>
                                     @else
                                     <p><i>Belum ada gambar</i></p>
                                     @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="angkatan">Angkatan</label>
                                    {!! Form::selectRange('angkatan', 2019, date('Y') + 1, null, [
                                     'class' => 'form-control',
                                     'placeholder' => 'Pilih Angkatan'])!!}
                                    <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="email">Email</label>
                                  <div class="form-group mb-3">
                                  {!! Form::email('email', null, ['class' => 'form-control','autofocus']) !!}
                                  <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="no_hp">No Hp</label>
                                    {!! Form::number('no_hp', null, ['class' => 'form-control','autofocus']) !!}
                                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                                </div>




                                <div class="form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                </div>
                            </div>

                        </div>





                        {!! Form::submit($button, ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>





@endsection
