<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AggregateCollectionTest extends TestCase
{
    /**
     * Aggregate
     * ● Laravel collection juga memiliki beberapa method untuk melakukan aggregate
     *
     * Method                    Keterangan
     * min()                     Mengambil data paling kecil
     * max()                     Mengambil data paling besar
     * avg() / average()         Mengambil rata-rata data
     * sum()                     Mengambil seluruh jumlah data
     * count()                   Mengambil total seluruh data
     */

    public function testAggregate()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $sum = $collection->sum(); // sum() // Mengambil seluruh jumlah data
        self::assertEquals(55, $sum);
        var_dump(json_encode($sum));

        $average = $collection->average(); // average() // Mengambil rata-rata data
        self::assertEquals(5.5, $average);
        var_dump(json_encode($average));

        $min = $collection->min(); // min() // Mengambil data paling kecil
        self::assertEquals(1, $min);
        var_dump(json_encode($min));

        $max = $collection->max(); // max() // Mengambil data paling besar
        self::assertEquals(10, $max);
        var_dump(json_encode($max));

        $count = $collection->count(); // count() // Mengambil total seluruh data
        self::assertEquals(10, $count);
        var_dump(json_encode($count));

    }
}
