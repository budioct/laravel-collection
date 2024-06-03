<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlicingCollectionTest extends TestCase
{
    /**
     * Slicing
     * ● Slicing adalah operasi untuk mengambil sebagian data di Collection
     *
     * Method                        Keterangan
     * slice(start)                  Mengambil data mulai dari start sampai data terakhir
     * slice(start, length)          Mengambil data mulai dari start sepanjang length
     */

    public function testSlice()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result1 = $collection->slice(3); // slice(offset) // mulai index dari 3 yaitu datanya adalah 4
        self::assertEqualsCanonicalizing([4, 5, 6, 7, 8, 9, 10], $result1->all());

        $result2 = $collection->slice(3, 5); // slice(offset, length) // mulai dari index, ambil data sepanjang yang di tentukan
        self::assertEqualsCanonicalizing([4, 5, 6, 7, 8], $result2->all());

    }
}
