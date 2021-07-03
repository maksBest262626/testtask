@extends('layouts.app')       <!-- /* наследуем из папки лаяут шаблон апп */ -->

@section('title')
    Results1
@endsection

@section('content')           <!-- /* вставляем наш код который ниже в секцию контент(которая в апп есть ес что) */ -->
<br>
<?php if ($flag) {
    echo "
        <div class='card-body w-100 text-center bg-light' align='center'>
        <h1 align='center'>Вы ничего не выбрали! Показaн весь каталог. </h1>
        <a class='btn btn-primary'  align='center' href='/' role='button'>К Поиску</a>
        </div>
        ";
}
?>
<br>
<table class="table-hover w-100 table-bordered text-center" align="center">
    <thead class="table-dark">
    <tr>
        <td scope=" col
        ">Название</td>
        <td scope=" col
        ">Количество просмотров</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($results as $result) {
        echo "
        <tr class='table-light'>
            <td class='table-light'><a href='/results/{$result->id}'> {$result->name} <a></td>
            <td class='table-light'>{$result->show_count}</td>
        </tr>
        ";
    }

    $fp = fopen('file.csv', 'w');
    foreach ($results as $result) {
        fputcsv($fp, [$result->id, $result->name], '-');
    }
    fclose($fp);

    ?>
    </tbody>
</table>
<br><br>
@endsection                   <!-- /* закрываем секцию */ -->
