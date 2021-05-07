@extends('layouts.app')

@section('js')
<script>
    var formSubmitting = false;
    var setFormSubmitting = function() {
        formSubmitting = true;
    };

    window.onload = function() {
        window.addEventListener("beforeunload", function(e) {
            if (formSubmitting) {
                return undefined;
            }

            var confirmationMessage = 'Are you sure you want to leave?';

            (e || window.event).returnValue = confirmationMessage; //Gecko + IE
            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        });
    };
</script>
<script>
    function checkAll() {
        var checkbox = document.querySelectorAll('#permission_cek');
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].type == 'checkbox') {
                checkbox[i].checked = true;
            }
        }
    }

    function uncheckAll() {
        var checkbox = document.querySelectorAll('#permission_cek');
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].type == 'checkbox') {
                checkbox[i].checked = false;
            }
        }
    }

</script>
@endsection

@section('breadcrumb')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">User Matrix</li>
    <li class="breadcrumb-item">
        <a href="{{ route('usrmatrix.role.index') }}">Role</a>
    </li>
    <li class="breadcrumb-item active">Tambah Role</li>
</ol>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header bg-primary">
            <strong>Tambah Role</strong>
        </div>
        @if(isset($roles))
        {!! Form::model($roles, ['route' => ['usrmatrix.role.update', $roles->IdRole], 'class' => 'form-horizontal', 'onsubmit' => 'setFormSubmitting()']) !!}
        @method('PUT')
        @else
        {!! Form::open(['route' => ['usrmatrix.role.store'], 'class' => 'form-horizontal', 'onsubmit' => 'setFormSubmitting()']) !!}
        @endif

        <div class="card-body">
            <div class="form-group row">
                {{ Form::label('Nama', 'Nama Role', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    {{ Form::text('Nama', null, ['class' => 'form-control ' . ($errors->has('Nama') ? 'is-invalid' : ''), 'maxLength' => 60]) }}
                    <span class="invalid-feedback">{{ $errors->first('Nama') }}</span>
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('Label', 'Label Role', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    {{ Form::text('Label', null, ['class' => 'form-control ' . ($errors->has('Label') ? 'is-invalid' : ''), 'maxLength' => 60]) }}
                    <span class="invalid-feedback">{{ $errors->first('Label') }}</span>
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('permission', 'Permission', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    <div>
                        <button type="button" class="btn btn-sm btn-success" onclick="checkAll()">Check All</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="uncheckAll()">Uncheck All</button>
                    </div>
                    <ul class="list-group border" style="max-height: 200px; overflow-y: auto">
                        @foreach($listpermission as $key => $value)
                        <li class="list-group-item">
                            <div class="form-check form-check-inline mr-1">
                                {!! Form::checkbox('IdPermission[]', $key, $value->Status, ['class' => 'form-check-input', 'id' => 'permission_cek']) !!}
                            </div>
                            {{ $value->Label }}
                        </li>
                        @endforeach
                    </ul>
                    @error('IdPermission')
                    <small class="text-danger">Silakan pilih permission</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('', '', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        {!! Form::checkbox('FlgAktif', true, isset($roles) ? null : true, ['class' => 'form-check-input', 'id' => 'flgaktif']) !!}
                        {{ Form::label('flgaktif', 'Aktif', ['class' => 'form-check-label ' . ($errors->has('FlgAktif') ? 'is-invalid' : '')]) }}
                    </div>
                    @if($errors->first('FlgAktif') != null)
                    <div class="alert alert-primary" role="alert">
                        Tidak bisa di nonaktifkan, masih digunakan oleh user
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="submit">
                <em class="fa fa-dot-circle-o"></em> Simpan</button>
            <a class="btn btn-sm btn-danger" href="{{ route('usrmatrix.role.index') }}">
                <em class="fa fa-ban"></em> Batal
            </a>
        </div>
        {!! Form::close() !!}
        <!-- /.row-->
    </div>
</div>
@endsection
