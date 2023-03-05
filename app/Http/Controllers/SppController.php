<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSppRequest;
use App\Http\Requests\UpdateSppRequest;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Models\Spp as Model;
use Illuminate\Support\Facades\Storage;

class SppController extends Controller
{
    private $viewIndex = 'spp_index';
    private $viewCreate = 'spp_form';
    private $viewEdit = 'spp_form';
    private $viewShow = 'spp_show';
    private $routePrefix = 'spp';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $models = Model::latest()->paginate('30');


       return view('administrator.dashboard.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Spp'
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
            'title' => 'Form Data Spp',
        ];

        return view('administrator.dashboard.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSppRequest $request)
    {


        Model::create($request->validated());
        // dd($requestData);
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
            'model' => Model::findOrFail($id),
            'title' => 'Detail Spp',
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
            'title' => 'Form Edit Spp',
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
    public function update(UpdateSppRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diupdate');
        return redirect()->route('spp.index');
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
