<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilteringCollectionTest extends TestCase
{
    /**
     * Filtering
     * ● Filtering adalah salah satu operasi collection yang banyak digunakan
     * ● Filtering membutuhkan function sebagai parameter
     * ● Jika function mengembalikan true, maka data akan diambil, jika false, maka data akan dibuang
     * ● Hati-hati ketika menggunakan data array dengan index number, karena data array bisa dihapus
     *   sehingga index akan hilang di Collection baru hasil filter
     *
     * Method                   Keterangan
     * filter(callback($item/value), $key){})         Iterasi setiap data, dikirim ke function, jika true maka data diambil, jika false, maka data dibuang
     */

    public function testFilter()
    {

        $collection = collect([
            "budhi" => 80,
            "ismat" => 79,
            "jamal" => 87,
            "rudy" => 92,
        ]);

        $result = $collection->filter(function ($item, $key) {
            return $item >= 80;
        }); // nilai collection yang memenuhi syarat collection akan di tampung collection baru, yang tidak akan di buang

        $this->assertEquals([
            "budhi" => 80,
            "jamal" => 87,
            "rudy" => 92,
        ], $result->all());
        var_dump($collection);
        var_dump($result);

    }

    public function testFilterIndex()
    {

        // perlu di perhatikan
        // note: method filter collection itu akan menghapus index juga saat di tampung collection baru

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $result = $collection->filter(function ($item, $key){
            return $item % 2 == 0; // data collection hasil modulus pembagian tidak ada sisi atau 0, maka datanya akan di tampung di collection baru
        });

        //$this->assertEquals([2,4,6,8,10], $result->all()); // jika menggunakan assertEquals(expetation, actual) // kita tidak bisa melaukan unit testing perbandingan
        $this->assertEqualsCanonicalizing([2,4,6,8,10], $result->all()); // unit testing ini bisa

        var_dump($collection);
        var_dump($result);

    }
}
