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
        <a href="{{ route('usrmatrix.user.index') }}">User Role</a>
    </li>

</ol>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header bg-primary">
            <strong>List User Role</strong>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <a class="btn btn-sm btn-success" href="{{ route('usrmatrix.user.create') }}">
                    <em class="fa fa-plus"></em> Add User
                </a>
            </div>
            <table class="table table-responsive-sm table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th scope='col' nowrap>Action</th>
                        <th scope='col'>Nama User</th>
                        <th scope='col'>User Login</th>
                        <th scope='col'>LDAP</th>
                        <th scope='col'>Role</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objects as $object)
                    <tr>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('usrmatrix.user.edit', ['user' => $object->IdUser]) }}">
                                <em class="fa fa-pencil"></em> Edit
                            </a>
                        </td>
                        <td>{{ $object->NmUser }}</td>
                        <td>{{ $object->UserLogin }}</td>
                        <td>
                            <div class="custom-control custom-checkbox mr-1">
                                {!! Form::checkbox('Ldap', true, $object->FlgLDAP ? true : false, ['class' => 'custom-control-input', 'id' => 'ldap', 'disabled' => true]) !!}
                                {{ Form::label(null, null, ['class' => 'custom-control-label', 'for' => 'ldap']) }}
                            </div>
                        </td>
                        <td>{{ $object->role->Label }}</td>
                        <td>{{ $object->FlgAktif ? 'Aktif' : 'Tidak Aktif' }}</td>
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
