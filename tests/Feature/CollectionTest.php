<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

class CollectionTest extends TestCase
{
    /**
     * Membuat Collection
     * ● Untuk membuat Collection, Laravel sudah menyediakan global function collect(array) yang
     *   digunakan untuk mengubah tipe data array menjadi Collection
     */

    public function testCreateCollection()
    {

        $data = array(1, 2, 3, 4, 5);

        // collect(array) adalah method global di laravel dia yang manage collection kumpulan data manipulasi
        $collection = collect($data); // collect(array) // konversi array ke collection
        $this->assertEqualsCanonicalizing($data, $collection->all()); // all() // mendapatkan semua data yang di tampung collection

        var_dump(json_encode($data)); // string(11) "[1,2,3,4,5]"
        var_dump(json_encode($collection)); // string(11) "[1,2,3,4,5]"

    }

    public function testForEachCollection()
    {

        /**
         * For Each
         * ● Collection adalah struktur data turunan dari Iterable PHP
         * ● Dengan demikian, kita bisa melakukan iterasi data Collection menggunakan perintah for PHP
         */

        $data = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

        $collection = collect($data);

        foreach ($collection as $index => $value) {
            $this->assertEquals($index + 1, $value);
            var_dump($index + 1 . " equals " . $value);
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

    public function testManipulasiCollection()
    {

        /**
         * Manipulasi Collection
         * ● Collection adalah sebuah class, oleh karena itu untuk memanipulasi data nya, kita perlu
         *   menggunakan method yang terdapat di Collection
         *
         * Collection Operations
         * Method               Keterangan
         * push(data)           Menambah data ke paling belakang
         * pop()                Menghapus dan mengambil data paling terakhir
         * prepend(data)        Menambah data ke paling depan
         * pull(key)            Menghapus dan mengambil data sesuai dengan key
         * put(key, data)       Mengubah data dengan key
         */

        $collection = collect([]);

        $collection->push("budhi", "jamal", "malik"); // push(data) Menambah data ke paling belakang
        $this->assertEqualsCanonicalizing(["budhi", "jamal", "malik"], $collection->all());
        var_dump($collection);

        $hapus_data = $collection->pop(); // pop() Menghapus dan mengambil data paling terakhir
        $this->assertEquals("malik", $hapus_data);
        $this->assertEqualsCanonicalizing(["budhi", "jamal"], $collection->all());
        var_dump($collection);

        $collection->prepend("dimas"); // prepend(data) Menambah data ke paling depan
        $this->assertEqualsCanonicalizing(["dimas", "budhi", "jamal"], $collection->all());
        var_dump($collection);

        $collection->pull("dimas"); // pull(key) Menghapus dan mengambil data sesuai dengan key
        $this->assertEqualsCanonicalizing(["dimas", "budhi", "jamal"], $collection->all());
        var_dump($collection);

        $collection->put("dimas", "asek asek jos"); // put(key, data) Mengubah data dengan key
        $this->assertEqualsCanonicalizing(["asek asek jos", "dimas", "budhi", "jamal"], $collection->all());
        var_dump($collection);
    }
}
