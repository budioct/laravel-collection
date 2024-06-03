<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZipCollectionTest extends TestCase
{
    /**
     * Zipping
     * ● Zipping adalah transformasi yang digunakan untuk menggabungkan dua buah collection.
     *
     * Zipping Operations
     * Method                           Keterangan
     * zip(collection/array)            Menggabungkan tiap item di collection sehingga menjadi collection baru
     * concat(collection/array)         Menambahkan collection pada bagian akhir sehingga menjadi collection baru
     * combine(collection/array)        Menggabungkan collection sehingga collection pertama menjadi key dan collection kedua menjadi value
     */

    public function testZip()
    {

        $collection1 = collect([1, 2, 3]);
        $collection2 = collect([4, 5, 6]);
        $collection3 = $collection1->zip($collection2); // zip(collection/array) // gabungkan collection index 0 dan collection index 0 dan seterusnya

        $this->assertEquals([
            collect([1, 4]),
            collect([2, 5]),
            collect([3, 6]),
        ], $collection3->all());
        var_dump(json_encode($collection3->all()));
        var_dump($collection3->all());

        /**
         * result:
         * // json
         * string(19) "[[1,4],[2,5],[3,6]]"
         *
         * // object php
         * array(3) {
         * [0]=>
         * object(Illuminate\Support\Collection)#939 (2) {
         * ["items":protected]=>
         * array(2) {
         * [0]=>
         * int(1)
         * [1]=>
         * int(4)
         * }
         * ["escapeWhenCastingToString":protected]=>
         * bool(false)
         * }
         * [1]=>
         * object(Illuminate\Support\Collection)#935 (2) {
         * ["items":protected]=>
         * array(2) {
         * [0]=>
         * int(2)
         * [1]=>
         * int(5)
         * }
         * ["escapeWhenCastingToString":protected]=>
         * bool(false)
         * }
         * [2]=>
         * object(Illuminate\Support\Collection)#940 (2) {
         * ["items":protected]=>
         * array(2) {
         * [0]=>
         * int(3)
         * [1]=>
         * int(6)
         * }
         * ["escapeWhenCastingToString":protected]=>
         * bool(false)
         * }
         * }
         */
    }

    public function testConcat(){

        $collection1 = collect([1, 2, 3]);
        $collection2 = collect([4, 5, 6]);
        $collection3 = $collection1->concat($collection2); // concat(collection/array) Menambahkan collection pada bagian akhir sehingga menjadi collection baru

        $this->assertEqualsCanonicalizing([1, 2, 3, 4, 5, 6], $collection3->all());
        var_dump(json_encode($collection3->all()));
        var_dump($collection3->all());

        /**
         * result:
         * // json
         * string(13) "[1,2,3,4,5,6]"
         * // object php
         * array(6) {
         * [0]=>
         * int(1)
         * [1]=>
         * int(2)
         * [2]=>
         * int(3)
         * [3]=>
         * int(4)
         * [4]=>
         * int(5)
         * [5]=>
         * int(6)
         * }
         */
    }

    public function testCombine()
    {
        $collection1 = collect(["name", "country"]); // collection menjadi key
        $collection2 = collect(["Budhi", "Indonesia"]); // collection menjadi value
        $collection3 = $collection1->combine($collection2); // combine(collection/array) Menggabungkan collection sehingga collection pertama menjadi key dan collection kedua menjadi value

        $this->assertEqualsCanonicalizing([
            "name" => "Budhi",
            "country" => "Indonesia"
        ], $collection3->all());
        var_dump(json_encode($collection3->all()));
        var_dump($collection3->all());

        /**
         * result:
         * // json
         * string(38) "{"name":"Budhi","country":"Indonesia"}"
         * // object php
         * array(2) {
         * ["name"]=>
         * string(5) "Budhi"
         * ["country"]=>
         * string(9) "Indonesia"
         * }
         */
    }
}
