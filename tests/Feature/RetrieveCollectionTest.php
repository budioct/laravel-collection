<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrieveCollectionTest extends TestCase
{
    /**
     * Retrieve
     * ● Retrieve adalah operasi untuk mengambil data di Collection
     *
     * Method                       Keterangan
     * first()                      Mengambil data pertama di collection, atau null jika tidak ada
     * firstOrFail()                Mengambil data pertama di collection, atau error ItemNotFoundException jika tidak ada
     * first(function)              Mengambil data pertama di collection yang sesuai dengan kondisi function jika menghasilkan data true
     * firstWhere(key, value)       Mengambil data pertama di collection dimana key sama dengan value
     */

    public function testFirst()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result1 = $collection->first(); // first() // Mengambil data pertama di collection, atau null jika tidak ada
        self::assertEquals(1, $result1); // int(1)
        var_dump($result1);

        // $collection->first(fn($item, $key) => $item > 5); // arrow method
        $result2 = $collection->first(function ($item, $key) {
           return $item > 5;
        });
        self::assertEquals(6, $result2); // int(6)
        var_dump($result2);

    }

    /**
     * Last Operations
     * Method                        Keterangan
     * last()                        Mengambil data terakhir di collection, atau null jika tidak ada
     * last(function)                Mengambil data terakhir di collection yang sesuai dengan kondisi function jika menghasilkan data true
     */

    public function testLast()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result1 = $collection->last(); // first() // Mengambil data pertama di collection, atau null jika tidak ada
        self::assertEquals(10, $result1); // int(10)
        var_dump($result1);

        // $collection->first(fn($item, $key) => $item > 5); // arrow method
        $result2 = $collection->last(function ($item, $key) {
            return $item < 5;
        });
        self::assertEquals(4, $result2); // int(4)
        var_dump($result2);

    }
}
