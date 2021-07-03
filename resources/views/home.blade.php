@extends('layouts.app')

@section('title')
    Main page
@endsection

@section('content')            <!-- /* вставляем наш код который ниже в секцию контент(которая в апп.blade.php есть ес что) */ -->
<br>
<form class="form-horizontal text-center" action="/results" method="get">
    {{ csrf_field() }}
    <br>
    <div class="row justify-content-center ">
        <div class="col-4">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal" align="center">Выбрать</h4>
                </div>
                <div class="card-body text-left">
                    <?php
                    $ids = DB::table('tags')->distinct()->get();
                    foreach ($ids as $id) {
                        echo "
                            <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='add[]' value='{$id->id}' id='flexCheckDefault'>
                            <label class='form-check-label' for='flexCheckDefault'>
                                {$id->name}
                            </label>
                             </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal" align="center">Исключить</h4>
                </div>
                <div class="card-body text-left">
                    <?php
                    $ids = DB::table('tags')->distinct()->get();
                    foreach ($ids as $id) {
                        echo "
                            <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='off[]' value='{$id->id}' id='flexCheckDefault'>
                            <label class='form-check-label' for='flexCheckDefault'>
                                {$id->name}
                            </label>
                             </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    @csrf
    <button type="submit" name="submit" align="center" class="w-50 btn btn-lg btn-primary">Посмотреть результаты
    </button>
</form>
@endsection
