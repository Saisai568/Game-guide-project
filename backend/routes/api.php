<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/guides', function () {
    // 這裡可以查詢資料庫獲取攻略列表
    return response()->json([
        ['id' => 10, 'title' => '遊戲攻略 1', 'content' => '這是第一篇攻略內容。'],
        ['id' => 20, 'title' => '遊戲攻略 2', 'content' => '這是第二篇攻略內容。'],
    ]);
});