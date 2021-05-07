@extends('layouts.app')

@section('css')

@endsection

@section('js')
<script src="{{ asset('js/vendor/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/vendor/datatables.net/dataTables.bootstrap4.js') }}"></script>
@include('shared.js.datatable')
@endsection

@section('breadcrumb')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Question</li>
    <li class="breadcrumb-item active">
        <a href="{{ route('question.number_1.index') }}">Number 1</a>
    </li>

</ol>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header bg-primary">
            <strong>List Data</strong>
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th scope='col' nowrap>Barcode</th>
                        <th scope='col'>Jumlah</th>
                        <th scope='col'>Total Harga</th>
                        <th scope='col'>Ready</th>
                        <th scope='col'>On Hold</th>
                        <th scope='col'>Delivered</th>
                        <th scope='col'>Packing</th>
                        <th scope='col'>Sent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objects as $object)
                    <tr>
                        <td>{{ $object->barcode }}</td>
                        <td>{{ $object->jumlah }}</td>
                        <td>{{ $object->total_harga }}</td>
                        <td>{{ $object->ready }}</td>
                        <td>{{ $object->onhold }}</td>
                        <td>{{ $object->delivered }}</td>
                        <td>{{ $object->packing }}</td>
                        <td>{{ $object->sent }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$objects->links('vendor.pagination.bootstrap-4')}} --}}
        </div>
        <!-- /.row-->
    </div>
</div>
@endsection
