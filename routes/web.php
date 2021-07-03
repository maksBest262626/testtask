<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/results', function () {

    if (!isset($_GET['add'])) {
        $add = [];
    } else {
        $add = $_GET['add'];
    }
    if (!isset($_GET['off'])) {
        $off = [];
    } else {
        $off = $_GET['off'];
    }


    $view = view('results');
    $add1 = '(' . join(',', $add) . ')';
    $off2 = '(' . join(',', $off) . ')';
//    $tempResults = DB::table('item_tag_links')->select('item_id')->where('item_id',$add)
//       // ->where('item_id',$off)
//        ->get();
//    $tempResults2[] = [];
//    foreach($tempResults as $result) {
//        $tempResults2[] = $result->item_id;
//    }
//    $results = DB::table('items')
////        ->where('id', $tempResults2)->get();
//    print_r($off);
//    $results = DB::table('items')->select('name', 'show_count')
//        ->join('item_tag_links', 'item_tag_links.item_id','=','items.id')
//
//       ->where('item_tag_links.tag_id', $add)
//        ->WhereNotIn('item_tag_links.tag_id', $off)
//        ->distinct('items.id')
//        ->get();
    $flag = false;
    $queryLink = "SELECT * FROM items";
    if (isset($_GET['add'])) {
        $queryLink .= " WHERE id IN
            (SELECT DISTINCT item_id
            FROM item_tag_links
            WHERE item_id IN (SELECT item_id FROM item_tag_links WHERE tag_id IN $add1)";
        if (isset($_GET['off'])) {
            $queryLink .= " AND
            item_id NOT IN (SELECT item_id FROM item_tag_links WHERE tag_id IN $off2)
            )";
        } else  $queryLink .= ")";
    } else $flag = true;
//    WHERE id IN
//(SELECT DISTINCT item_id
//FROM item_tag_links
//".(isset($_GET['add'])?"
//WHERE item_id IN (SELECT item_id FROM item_tag_links WHERE tag_id IN $add1)":"
//").(isset($_GET['off'])?"
//AND
//item_id NOT IN (SELECT item_id FROM item_tag_links WHERE tag_id IN $off2)
//    )":")");
    $results = DB::select($queryLink);
    $view->results = $results;
    $view->flag = $flag;
    return $view;
});

Route::get('/results/{id}', function($id) {
    $view = view('production');
    $results = DB::table('items')->where('id',$id)->value('name');
    $new_count = DB::table('items')->where('id',$id)->value('show_count') + 1;
    $view->results = $results;
    $view->new_count = $new_count;
    DB::table('items')->where('id',$id)->update(['show_count' => $new_count]);
    return $view;
});

Route::get('/exit', function () {
    return view('exit');
})->name('exit');
