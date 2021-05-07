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
    <li class="breadcrumb-item">User Matrix</li>
    <li class="breadcrumb-item active">
        <a href="{{ route('usrmatrix.role.index') }}">Role</a>
    </li>

</ol>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header bg-primary">
            <strong>List Role</strong>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <a class="btn btn-sm btn-success" href="{{ route('usrmatrix.role.create') }}">
                    <em class="fa fa-plus"></em> Add
                </a>
            </div>
            <table class="table table-responsive-sm table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th scope='col' nowrap>Action</th>
                        <th scope='col'>Role</th>
                        <th scope='col'>Permission</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objects as $object)
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('usrmatrix.role.edit', ['role' => $object->IdRole]) }}">
                                <em class="fa fa-pencil"></em> Edit
                            </a>
                        </td>
                        <td>{{ $object->Label }}</td>
                        <td>
                            @foreach($object->permissions as $permission)
                            <ul>
                                <li>{{ $permission->Label }}</li>
                            </ul>
                            @endforeach
                        </td>
                        <td>
                            {{ $object->FlgAktif ? 'Aktif' : 'Tidak Aktif' }}
                        </td>
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
