@extends('layouts.app')

@section('css')

@endsection


<?php
$data = json_encode($arr);
// var_dump($arr);die();
?>
@section('js')
<script>
    $(document).ready(function() {
        var arr     = <?=json_encode($arr)?>;
        var result  = [];
        
        for(var i=0;i<arr.length;i++){
            if(arr[i] < 0){
                var cek = arr[i] * -1;
                var find = arr.indexOf(cek);
                result.push(arr[find]);
                
            }
        }

        console.log(result);
    });

</script>
@endsection

@section('breadcrumb')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Question</li>
    <li class="breadcrumb-item active">
        <a href="{{ route('question.number_2.index') }}">Number 2</a>
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

            <div class="form-group row">
                    <div class="col-md-1">
                        <strong>DATA</strong>
                    </div>
                    <div class="col-md-9">
                        <?php
                            print_r($arr);
                        ?>
                    </div>
            </div>

            <div class="form-group row">
                    <div class="col-md-1">
                        <strong>PHP</strong>
                    </div>
                    <div class="col-md-9">
                        <?php
                            print_r($result);
                        ?>
                    </div>
            </div>

            <div class="form-group row">
                    <div class="col-md-1">
                        <strong>Javascript</strong>
                    </div>
                    <div class="col-md-9">
                        return on console
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
