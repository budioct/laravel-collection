<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    /**
     * Membuat Collection
     * ● Untuk membuat Collection, Laravel sudah menyediakan global function collect(array) yang
     *   digunakan untuk mengubah tipe data array menjadi Collection
     */

    public function testCreateCollection(){

        $data = array(1,2,3,4,5);

        // collect(array) adalah method global di laravel dia yang manage collection kumpulan data manipulasi
        $collection = collect($data); // collect(array) // konversi array ke collection
        $this->assertEqualsCanonicalizing($data, $collection->all()); // all() // mendapatkan semua data yang di tampung collection

        var_dump(json_encode($data)); // string(11) "[1,2,3,4,5]"
        var_dump(json_encode($collection)); // string(11) "[1,2,3,4,5]"

    }

    public function testForEachCollection(){

        /**
         * For Each
         * ● Collection adalah struktur data turunan dari Iterable PHP
         * ● Dengan demikian, kita bisa melakukan iterasi data Collection menggunakan perintah for PHP
         */

        $data = array(1,2,3,4,5,6,7,8,9,10);

        $collection = collect($data);

        foreach ($collection as $index => $value){
            $this->assertEquals($index + 1, $value);
            var_dump($index + 1 ." equals ". $value);
        }

        /**
         * result:
         * string(3) "0 1"
         * string(3) "1 2"
         * string(3) "2 3"
         * string(3) "3 4"
         * string(3) "4 5"
         * string(3) "5 6"
         * string(3) "6 7"
         * string(3) "7 8"
         * string(3) "8 9"
         * string(4) "9 10"
         */

    }
}
