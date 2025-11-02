<?php

namespace Tests\Unit;

use App\Models\Character;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function test_fillable_fields_are_defined()
    {
        $character = new Character();

        $expected = [
            'name_cn',
            'name_en',
            'tier',
            'element',
            'weapon_type',
            'image_url',
            'role',
        ];

        $this->assertEquals($expected, $character->getFillable());
    }

    public function test_mass_assignment_sets_attributes()
    {
        $data = [
            'name_cn' => '測試角色',
            'name_en' => 'Test Character',
            'tier' => 'S',
            'element' => 'Fire',
            'weapon_type' => 'Sword',
            'image_url' => 'https://example.com/img.png',
            'role' => 'DPS',
        ];

        $character = new Character($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $character->{$key});
        }
    }

    public function test_default_table_name()
    {
        $character = new Character();

        $this->assertEquals('characters', $character->getTable());
    }
}
