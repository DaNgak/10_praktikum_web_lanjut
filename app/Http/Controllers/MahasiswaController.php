<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = $mahasiswa = DB::table('mahasiswa')->paginate(3); // Mengambil semua isi tabel
        $mahasiswa = Mahasiswa::with("kelas")->orderBy('nim', 'asc')->paginate(3);
        $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
        return view('mahasiswa.index', [
            "mahasiswa" => $mahasiswa,
            "paginate" => $paginate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ["kelas" => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->get("Nim");
        $mahasiswa->nama = $request->get("Nama");
        // $mahasiswa->kelas_id = $mahasiswa->kelas()->associate(Kelas::find($request->get("Kelas")));
        $mahasiswa->kelas_id = $request->get("Kelas");
        $mahasiswa->jurusan = $request->get("Jurusan");
        $mahasiswa->email = $request->get("Email");
        $mahasiswa->alamat = $request->get("Alamat");
        $mahasiswa->tanggal = $request->get("Tanggal");
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with("kelas")->where("nim", $Nim)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Kelas = Kelas::all();
        $Mahasiswa = Mahasiswa::with("kelas")->where('nim', $Nim)->first();;
        return view('mahasiswa.edit', compact('Mahasiswa', 'Kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_Lahir' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($Nim)->update($request->all());
        $mahasiswa = Mahasiswa::with("kelas")->where('nim', $Nim)->first();
        $mahasiswa->nim = $request->get("Nim");
        $mahasiswa->nama = $request->get("Nama");
        $mahasiswa->kelas()->associate(Kelas::find($request->get("Kelas")));
        $mahasiswa->jurusan = $request->get("Jurusan");
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
