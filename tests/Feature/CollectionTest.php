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
}
