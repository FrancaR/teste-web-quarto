<?php

use App\Models\Property;
use App\Models\PropertyPhoto as Photo;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Property::class, 50)->create()->each(function (Property $property) {
            $property->photos()->createMany(
                factory(Photo::class, 8)->make()->toArray()
            );
        });
    }
}
