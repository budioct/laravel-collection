<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PartitioningCollectionTest extends TestCase
{
    /**
     * Partitioning
     * ● Pada filtering, kita akan kehilangan data yang tidak masuk kondisi filter function nya
     * ● Dengan partitioning, kita bisa mendapatkan dua collection yang terdiri dari collection yang masuk
     *   filter dan yang tidak masuk filter
     *
     * Method                   Keterangan
     * partition(function) Iterasi setiap data, dikirim ke function, jika true maka data akan masuk ke collection pertama, jika false maka data akan masuk ke collection kedua
     */

    public function testPartitioning()
    {

        $collection = collect([
            "budhi" => 80,
            "ismat" => 79,
            "jamal" => 87,
            "rudy" => 92,
        ]);

        [$result1, $result2] = $collection->partition(function ($item, $key) {
            return $item >= 80;
        }); // jika memenuhi syarat datanya akan di tampung di array 1 ($result1), dan tidak memenuhi syarat datanya di tampung array ke 2 ($result2)

        // data yang memenuhi syarat
        $this->assertEquals([
            "budhi" => 80,
            "jamal" => 87,
            "rudy" => 92,
        ], $result1->all());

        // data yang tidak memenuhi syarat
        $this->assertEquals([
            "ismat" => 79,
        ], $result2->all());

        var_dump($collection);
        var_dump($result1);
        var_dump($result2);

    }
}
