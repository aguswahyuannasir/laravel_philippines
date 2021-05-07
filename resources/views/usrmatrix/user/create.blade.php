@extends('layouts.app')

@section('css')
<link href="{{ asset('css/vendor/select2/select2.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('js/vendor/select2/select2.js') }}"></script>
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
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select a role"
        });

        if ($('#is_ldap').prop('checked') === true) {
            $('#password').attr('disabled', true);
        } else {
            $('#password').attr('disabled', false);
        }

        $('#is_ldap').change(function(e) {
            $('#password').attr('disabled', this.checked);
        })

    });

</script>
@endsection

@section('breadcrumb')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">User Matrix</li>
    <li class="breadcrumb-item">
        <a href="{{ route('usrmatrix.user.index') }}">User Role</a>
    </li>
    <li class="breadcrumb-item active">Tambah User</li>
</ol>
@endsection

@section('content')
<div class="animated fadeIn">
    <div class="card">
        <div class="card-header bg-primary">
            <strong>Tambah User</strong>
        </div>
        @if(isset($user))
        {!! Form::model($user, ['route' => ['usrmatrix.user.update', $user->IdUser], 'class' => 'form-horizontal', 'onsubmit' => 'setFormSubmitting()']) !!}
        @method('PUT')
        @else
        {!! Form::open(['route' => ['usrmatrix.user.store'], 'class' => 'form-horizontal', 'onsubmit' => 'setFormSubmitting()']) !!}
        @endif

        <div class="card-body">
            <div class="form-group row">
                {{ Form::label('NmUser', 'Nama', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    {{ Form::text('NmUser', null, ['class' => 'form-control ' . ($errors->has('NmUser') ? 'is-invalid' : ''), 'maxLength' => 60]) }}
                    <span class="invalid-feedback">{{ $errors->first('NmUser') }}</span>
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('UserLogin', 'User Login', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-7">
                    {{ Form::text('UserLogin', null, ['class' => 'form-control ' . ($errors->has('UserLogin') ? 'is-invalid' : ''), 'maxLength' => 60]) }}
                    <span class="invalid-feedback">{{ $errors->first('UserLogin') }}</span>
                </div>
                <div class="col-md-2">
                    <div class="form-check form-check-inline mr-1">
                        {!! Form::checkbox('FlgAktif', true, isset($user) ? $user->FlgAktif : true, ['class' => 'form-check-input', 'id' => 'aktif']) !!}
                        <label class="form-check-label" for="aktif">
                            Aktif
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                {{ Form::label('FlgLDAP', 'LDAP', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-2">
                    <div class="form-check form-check-inline mr-1">
                        {!! Form::checkbox('FlgLDAP', true, null, ['class' => 'form-check-input', 'id' => 'is_ldap']) !!}
                        <label class="form-check-label" for="is_ldap">
                            Aktif
                        </label>
                    </div>
                </div>
            </div>
            @if(empty($user) || (isset($user) ? !isset($user->Password) : null))
            <div class="form-group row">
                {{ Form::label('Password', 'Password', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    {{ Form::text('Password', null, ['class' => 'form-control ' . ($errors->has('Password') ? 'is-invalid' : ''), 'id' => 'password', (isset($user) ? $user->FlgLDAP ? 'disabled' : null : null )]) }}
                    <span class="invalid-feedback">{{ $errors->first('Password') }}</span>
                </div>
            </div>
            @endif
            <div class="form-group row">
                {{ Form::label('IdRole', 'Role', ['class' => 'col-md-3 col-form-label']) }}
                <div class="col-md-9">
                    {{ Form::select('IdRole', [null => ''] + $listrole, null, ['class' => 'form-control select2 ' . ($errors->has('IdRole') ? 'is-invalid' : '')]) }}
                    <span class="invalid-feedback">{{ $errors->first('IdRole') }}</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="submit">
                <em class="fa fa-dot-circle-o"></em> Simpan</button>
            <a class="btn btn-sm btn-danger" href="{{ route('usrmatrix.user.index') }}">
                <em class="fa fa-ban"></em> Batal
            </a>
        </div>
        {!! Form::close() !!}
        <!-- /.row-->
    </div>
</div>
@endsection
