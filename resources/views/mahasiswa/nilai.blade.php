@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <h1>KARTU HASIL STUDI (KHS)</h1>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-auto">
            <p><b>Nama</b>: {{ $daftar->mahasiswa->nama }}</p>
            <p><b>NIM</b>: {{ $daftar->mahasiswa->nim }}</p>
            <p><b>Kelas</b>: {{ $daftar->mahasiswa->kelas->nama_kelas }}</p>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        @foreach ($daftar as $matkul)
            <tr>
                <td>{{ $matkul->matakuliah->nama_matkul }}</td>
                <td>{{ $matkul->matakuliah->sks }}</td>
                <td>{{ $matkul->matakuliah->semester }}</td>
                <td>{{ $matkul->nilai }}</td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center my-5">
        <a href="{{ url('/mahasiswa/cetak_pdf/'. $matkul->id) }}" class="btn btn-danger">Export  PDF</a>
    </div>
@endsection