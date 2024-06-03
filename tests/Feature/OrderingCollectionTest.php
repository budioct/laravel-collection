<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderingCollectionTest extends TestCase
{
    /**
     * Ordering
     * ● Ordering adalah operasi untuk melakukan pengurutan data di Collection
     * Method                               Keterangan
     * sort()                               Mengurutkan secara ascending
     * sortBy(key/function)                 Mengurutkan secara ascending berdasarkan key atau function
     * sortDesc()                           Mengurutkan secara descending
     * sortByDesc(key/function)             Mengurutkan secara descending berdasarkan key atau function
     * sortKeys()                           Mengurutkan secara ascending berdasarkan keys
     * sortKeysDesc()                       Mengurutkan secara descending berdasarkan keys
     * reverse()                            Membalikkan urutan collection
     */

    public function testOrdering()
    {

        $collection = collect(["budhi", "octaviansyah", "22"]);
        $ascending = $collection->sort(); // sort() // mengurutkan secara ascending
        self::assertEqualsCanonicalizing(["budhi", "octaviansyah", "22"], $ascending->all());

        $descending = $collection->sortDesc(); // sortDesc() // Mengurutkan secara descending
        self::assertEqualsCanonicalizing(["22", "octaviansyah", "budhi",], $descending->all());

        $descending = $collection->reverse(); // reverse() // Membalikkan urutan collection
        self::assertEqualsCanonicalizing(["22", "octaviansyah", "budhi",], $descending->all());

    }
}
