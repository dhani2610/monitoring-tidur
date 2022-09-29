@extends('BE.app')

@section('style-BE')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content-BE')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
                  {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> --}}
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white" type="button">
                     <i class="mdi mdi-calendar"></i> Today ({{ date('Y-m-d') }})
                    </button>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="myTable" class="display expandable-table" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID DKTS</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Kecamatan</th>
                                <th>Desa/Keluragan</th>
                                <th>Alamat</th>
                                <th>Dusun</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>NO KK</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Tempat Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Pekerjaan</th>
                                <th>Nam Ibu Kandung</th>
                                <th>Hub Keluarga</th>
                                <th>Keterangan Padan</th>
                                <th>BANSOS BPNT</th>
                                <th>BANSOS PKH</th>
                                <th>BANSOS BPNT-PPKM</th>
                                <th>PBI JKN</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id_dkts }}</td>
                                    <td>{{ $item->provinsi }}</td>
                                    <td>{{ $item->kabupaten_kota }}</td>
                                    <td>{{ $item->kecamatan }}</td>
                                    <td>{{ $item->desa_kelurahan }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->dusun }}</td>
                                    <td>{{ $item->rt }}</td>
                                    <td>{{ $item->rw }}</td>
                                    <td>{{ $item->nokk }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td>{{ $item->tempat_lahir }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>{{ $item->nama_ibu_kandung }}</td>
                                    <td>{{ $item->hub_keluarga }}</td>
                                    <td>{{ $item->keterangan_padan }}</td>
                                    <td>{{ $item->bansos_bpnt }}</td>
                                    <td>{{ $item->bansos_pkh }}</td>
                                    <td>{{ $item->bansos_bpnt_ppkm }}</td>
                                    <td>{{ $item->pbi_jkn }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</div>
@endsection

@section('script-BE')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection