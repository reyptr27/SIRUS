@extends('layouts.layout')

@section('title')
    SIRUS | FORM PERMINTAAN PEMERIKSAAN CEK LAB
@endsection

@section('css-extra')
<style>
    th { font-size: 14px; }
    td { font-size: 12px; }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- content header -->
    <section class="content-header">
    <h1>
        FORM PERMINTAAN PEMERIKSAAN CEK LAB
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Formulir TAM</a></li>
        <li class="active"><a href="{{ route('ceklab.index') }}">Form Cek Lab</a></li>
    </ol>
    </section>  

    <!-- Section konten -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">List Form Permintaan Pemeriksaan Cek Lab</h3>
                        <a href="{{ route('ceklab.create') }}" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Tambah
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable" width="100%">
                                <thead>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">NOMOR DOCUMENT</th>
                                    <th class="text-center">TGL. PERMOHONAN</th>
                                    <th class="text-center">NAMA RS</th>
                                    <th class="text-center">LABORATORIUM</th>
                                    <th class="text-center" width="10%">FILE (DOKUMEN)</th>
                                    <th class="text-center" width="13%">ACTION</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>   
            </div>
        </div>        
    </section>
</div>
@endsection

@section('js-extra')
    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('ceklab.json') }}',
                columns: [
                    { data: 'id', name: 'tam_ceklab.id', "visible": false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false,searchable: false, className: "text-center"},
                    { data: 'nomor', name: 'tam_ceklab.nomor'},
                    { data: 'created_at', name: 'tam_ceklab.created_at'},
                    { data: 'nama_rs', name: 'rumah_sakit.nama_rs'},
                    { data: 'pihak_ketiga', name: 'tam_ceklab.pihak_ketiga'},                    
                    { data: 'upload', name: 'tam_ceklab.upload', orderable: false, searchable: false, className: "text-center"},                    
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
                ],
                "order": [0, 'DESC']
            });
        });
    </script>
@endsection