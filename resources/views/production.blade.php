@extends('layouts.app')

@section('title')
    Main page
@endsection

@section('content')            <!-- /* вставляем наш код который ниже в секцию контент(которая в апп.blade.php есть ес что) */ -->
<br>
<form class="form-horizontal text-center" action="/" method="get">
    {{ csrf_field() }}
    <br>
    <div class="row justify-content-center ">
        <div class="col-4">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">

                    <h4 class="my-0 fw-normal" align="center">
                        <?php echo $results; ?> Количество просмотров:<?php echo $new_count; ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    @csrf
    <button type="submit" name="submit" align="center" class="w-50 btn btn-lg btn-primary">К поиску!
    </button>
</form>
@endsection
