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

        // Insert sample characters
        Character::insert($characters);
    }
}
