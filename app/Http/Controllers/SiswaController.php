<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use \App\Models\Siswa as Model;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    private $viewIndex = 'siswa_index';
    private $viewCreate = 'siswa_form';
    private $viewEdit = 'siswa_form';
    private $viewShow = 'siswa_show';
    private $routePrefix = 'siswas';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $models = Model::query();
        if ($request->filled('q')) {
            $models = Model::with('kelas','user')->search($request->q)->paginate(10);
        } else {
            $models = Model::with('kelas','user')->latest()->paginate('30');
        }

       return view('administrator.dashboard.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data siswa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model'  => new  Model(),
            'method' => 'POST',
            'route'  => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Siswa',
            'kelas' => Kelas::pluck('nama_kelas', 'id'),
            // 'jurusan' => Kelas::pluck('kompetensi_keahlian', 'id'),
        ];

        return view('administrator.dashboard.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaRequest $request)
    {
        $requestData = $request->validated();
        if($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('public/foto');
        }
        // if($request->filled('wali_id')) {
            //     $requestData['wali_status'] = 'ok';
        // }

        $requestData['user_id'] = auth()->user()->id;
        $requestData['username'] =  $requestData['name'];
        $requestData['password'] =  bcrypt($requestData['nis']);
        // dd($requestData);




        Model::create($requestData);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('administrator.dashboard.' .$this->viewShow, [
            'model' => Model::with('kelas', 'user')->findOrFail($id),
            'title' => 'Detail Siswa',
            'routePrefix' => $this->routePrefix,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'model'  => Model::findOrFail($id),
            'method' => 'PUT',
            'route'  => [ $this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Form Edit Siswa',
            'kelas' => Kelas::pluck('nama_kelas', 'id'),
            // 'wali' => User::where('akses', 'wali')->pluck('name', 'id')
        ];

        return view('administrator.dashboard.' . $this->viewEdit, $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, $id)
    {
        $requestData = $request->validated();

        $model = Model::findOrFail($id);
        if($request->hasFile('foto')) {
            if ($model->foto != null && Storage::exists($model->foto)) {
                # code...
                Storage::delete($model->foto);
            }
            $requestData['foto'] = $request->file('foto')->store('public/foto');
        }
        // if($request->filled('wali_id')) {
        //     $requestData['wali_status'] = 'ok';
        // }
        $requestData['user_id'] = auth()->user()->id;
        $requestData['username'] =  $requestData['name'];
        $requestData['password'] =  bcrypt($requestData['nis']);

        $model->fill($requestData);
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('siswas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::firstOrFail();
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
