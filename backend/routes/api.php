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

Route::get('/characters', function () {
    // 這裡可以查詢資料庫獲取角色列表
    return response()->json([
        ['id' => 1, 'name' => '魈', 'element' => 'Anemo', 'tier' => 'S', 'weapon' => 'Polearm', 'role' => 'DPS', 'image' => 'src/assets/6ljd0fuxbygzw1set0zvvaieqgxz9hu.webp'],
        ['id' => 2, 'name' => '楓原萬葉', 'element' => 'Anemo', 'tier' => 'A', 'weapon' => 'Sword', 'role' => 'Support', 'image' => 'src/assets/6ljd0fuxbygzw1set0zvvaieqgxz9hu.webp'],
        ['id' => 3, 'name' => '晴', 'element' => 'Electro', 'tier' => 'S', 'weapon' => 'Sword', 'role' => 'DPS', 'image' => 'src/assets/6ljd0fuxbygzw1set0zvvaieqgxz9hu.webp'],
    ]);
});