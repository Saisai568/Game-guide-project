<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CharacterSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        $characters = [
            [
                'name_cn' => '魈',
                'name_en' => 'Xiao',
                'tier' => 'S',
                'element' => 'Anemo',
                'weapon_type' => 'Polearm',
                'role' => 'DPS',
                'description' => 'A vigilant Yaksha with powerful plunge attacks.',
                'image_url' => 'src/assets/0qs4vaonwjatcfuak8e1dc9bxtpwkac.webp',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '宵宫',
                'name_en' => 'Yoimiya',
                'tier' => 'A',
                'element' => 'Pyro',
                'weapon_type' => 'Bow',
                'role' => 'DPS',
                'description' => 'A pyrotechnic archer who excels in charged attacks.',
                'image_url' => 'https://example.com/images/yoimiya.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '甘雨',
                'name_en' => 'Ganyu',
                'tier' => 'S',
                'element' => 'Cryo',
                'weapon_type' => 'Bow',
                'role' => 'DPS',
                'description' => 'Half-qilin adeptus with a powerful charged shot.',
                'image_url' => 'https://example.com/images/ganyu.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '行秋',
                'name_en' => 'Xingqiu',
                'tier' => 'A',
                'element' => 'Hydro',
                'weapon_type' => 'Sword',
                'role' => 'Support',
                'description' => 'A sword-user who provides off-field Hydro support.',
                'image_url' => 'https://example.com/images/xingqiu.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '班尼特',
                'name_en' => 'Bennett',
                'tier' => 'B',
                'element' => 'Pyro',
                'weapon_type' => 'Sword',
                'role' => 'Support',
                'description' => 'An optimistic adventurer who provides heals and buffs.',
                'image_url' => 'https://example.com/images/bennett.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '雷电将军',
                'name_en' => 'Raiden Shogun',
                'tier' => 'S',
                'element' => 'Electro',
                'weapon_type' => 'Polearm',
                'role' => 'Sub-DPS',
                'description' => 'The Electro Archon who excels at energy generation and burst damage.',
                'image_url' => 'https://example.com/images/raiden.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '阿贝多',
                'name_en' => 'Albedo',
                'tier' => 'A',
                'element' => 'Geo',
                'weapon_type' => 'Sword',
                'role' => 'Support',
                'description' => 'A Geo alchemist who provides off-field damage and utility.',
                'image_url' => 'https://example.com/images/albedo.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_cn' => '温迪',
                'name_en' => 'Venti',
                'tier' => 'S',
                'element' => 'Anemo',
                'weapon_type' => 'Bow',
                'role' => 'Support',
                'description' => 'A bard who excels at crowd control and energy regen.',
                'image_url' => 'https://example.com/images/venti.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Attempt to fetch official Chinese names from Hoyoverse; fallback to placeholders when necessary
        $names = [];
        try {
            $html = @file_get_contents('https://zenless.hoyoverse.com/zh-tw/characters');
            if ($html !== false) {
                if (preg_match_all('/>\s*([\x{4e00}-\x{9fff}]{2,8})\s*</u', $html, $m)) {
                    $cand = array_map('trim', $m[1]);
                    $filterOut = ['絕區零', '角色', '角色列表'];
                    foreach ($cand as $c) {
                        if (in_array($c, $filterOut)) continue;
                        if (mb_strlen($c) < 2) continue;
                        if (!in_array($c, $names)) $names[] = $c;
                        if (count($names) >= 34) break;
                    }
                }
            }
        } catch (\Exception $e) {
            // ignore, will fallback
        }

        if (count($names) < 34) {
            for ($i = count($names) + 1; $i <= 34; $i++) {
                $names[] = '絕區零_角色_' . $i;
            }
        }

        // Prepare new records for ids 9..42
        $tiers = ['S','A','B','C'];
        $elements = ['Pyro','Hydro','Anemo','Electro','Cryo','Geo'];
        $weapons = ['Sword','Bow','Polearm','Catalyst','Dagger'];
        $roles = ['DPS','Support','Healer','Sub-DPS'];

        $new = [];
        $id = 9;
        foreach ($names as $n) {
            if ($id > 42) break;
            $new[] = [
                'id' => $id,
                'name_cn' => $n,
                'name_en' => null,
                'tier' => $tiers[array_rand($tiers)],
                'element' => $elements[array_rand($elements)],
                'weapon_type' => $weapons[array_rand($weapons)],
                'role' => $roles[array_rand($roles)],
                'description' => null,
                'image_url' => 'src/assets/placeholder_'.$id.'.webp',
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $id++;
        }

        // Insert existing sample characters first (they don't include explicit IDs)
        if (!empty($characters)) {
            foreach (array_chunk($characters, 50) as $chunk) {
                Character::insertOrIgnore($chunk);
            }
        }

        // Then insert new records with explicit ids (9..42)
        if (!empty($new)) {
            foreach (array_chunk($new, 50) as $chunk) {
                Character::insertOrIgnore($chunk);
            }
        }
    }
}
