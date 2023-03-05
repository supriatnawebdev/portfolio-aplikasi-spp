<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TagihanDetail;
use Illuminate\Support\Carbon;
use App\Models\Tagihan as Model;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;

class TagihanController extends Controller
{
    private $viewIndex = 'tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewShow = 'tagihan_show';
    private $routePrefix = 'tagihan';




    public function index(Request $request)
    {
        if($request->filled('bulan') && $request->filled('tahun')) {
            $models = Model::latest()
            ->whereMonth('tanggal_tagihan', $request->bulan)
            ->whereYear('tanggal_tagihan', $request->tahun)
            ->paginate(30);
        } else {

            $models = Model::latest()->paginate('30');
        }

       return view('administrator.dashboard.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Tagihan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswas = Siswa::all();

        $data = [
            'model'  => new  Model(),
            'method' => 'POST',
            'route'  => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Form Data Tagihan',
            'angkatan' => $siswas->pluck('angkatan', 'angkatan'),
            'kelas' => Kelas::get()->pluck('nama_kelas', 'id'),
            // 'spp' => spp::get()->pluck('nama_spp_full', 'id'),
            'spp' => Spp::get()
        ];

        return view('administrator.dashboard.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagihanRequest $request)
    {

        $requestData = $request->validated();
        $sppIdArray = $requestData['spp_id'];

        $siswa = Siswa::query();
        if($requestData['kelas'] != ''){
            $siswa->where('kelas_id', $requestData['kelas']);
        }

        if($requestData['angkatan'] != ''){
            $siswa->where('angkatan', $requestData['angkatan']);
        }

        $siswa = $siswa->get();
        // dd($siswa);
        foreach($siswa as $item) {
            $itemSiswa = $item;
            $spp = spp::whereIn('id', $sppIdArray)->get();
            // dd($spp);
            $dataTagihan = [
                'siswa_id' => $itemSiswa->id,
                'angkatan' => $requestData['angkatan'],
                'kelas' => $requestData['kelas'],
                'tanggal_tagihan' => $requestData['tanggal_tagihan'],
                'tanggal_jatuh_tempo' => $requestData['tanggal_jatuh_tempo'],
                'keterangan' => $requestData['keterangan'],
                'status' => 'baru'

            ];
            // dd($dataTagihan);
            // print_r($dataTagihan);
            // echo "<br>";

            $tanggalJatuhTempo = Carbon::parse($requestData['tanggal_jatuh_tempo']);
            $tanggalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
            $bulanTagihan = $tanggalTagihan->format('m');
            $tahunTagihan = $tanggalTagihan->format('Y');
            $cekTagihan = Model::where('siswa_id', $itemSiswa->id)
            ->whereMonth('tanggal_tagihan', $bulanTagihan)
            ->whereYear('tanggal_tagihan', $tahunTagihan)
            ->first();

            if($cekTagihan == null){
                $tagihan = Model::create($dataTagihan);
                foreach($spp as $itemspp){
                    $detail = TagihanDetail::create([
                        'tagihan_id' => $tagihan->id,
                        'nama_biaya' => $itemspp->tahun,
                        'jumlah_biaya' => $itemspp->nominal,
                    ]);
                    // dd($detail);
                }
            }

        }

        flash("Data Tagihan berhasil disimpan")->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tagihan = Model::with('pembayaran')->findOrFail($id);
        // dd($tagihan);
        $data['tagihan'] = $tagihan;
        $data['siswa'] = $tagihan->siswa;
        $data['periode'] = Carbon::parse($tagihan->tanggal_tagihan)->format('F Y');
        $data['model'] = new Pembayaran();
        // dd($data['siswa']);

        return view('administrator.dashboard.tagihan_show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagihanRequest  $request
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagihanRequest $request, Model $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $tagihan)
    {
        $model = Model::firstOrFail();
        $model->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}
