<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlatCollectionTest extends TestCase
{
    /**
     * Flattening
     * ● Flattening adalah operasi transformasi untuk menjadikan nested collection menjadi flat
     * jadi jika ada collection nested kita bisa gunakan Flattening
     *
     * Zipping Operations
     * Method               Keterangan
     * collapse()           Mengubah tiap array di item collection menjadi flat collection
     * flatMap(function)    Iterasi tiap data, dikirim ke function yang menghasilkan collection, dan diubah menjadi flat collection
     */

    public function testCollapse()
    {

        $collection = collect([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ]);

        $result = $collection->collapse(); // collapse // otomatis semua data array nested akan di keluarkan menjadi 1 data array saja
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9], $result->all());

        var_dump(json_encode($collection)); // "[[1,2,3],[4,5,6],[7,8,9]]"
        var_dump(json_encode($result)); // "[1,2,3,4,5,6,7,8,9]"

    }

    public function testFlatMap(){

        $collection = collect([
            [
                "name" => "budhi",
                "hobbies" => ["eating", "running"],
            ],
            [
                "name" => "hasan",
                "hobbies" => ["swiming", "futsal"],
            ],
            [
                "name" => "budhi",
                "hobbies" => ["rancing", "reading"],
            ],
        ]); // bentuk data jika array nested ada nested lagi kita bisa menggunakan flatMap(callback) dan menghasilkan variable baru

        $hobbies = $collection->flatMap(function($data){
           return $data["hobbies"]; // $data["key"] collection  // otomatis semua data array nested akan di keluarkan menjadi 1 data array saja
        }); // gabungkan nested array di dalam array pada key hobbies

        $this->assertEquals(["eating", "running", "swiming", "futsal", "rancing", "reading"], $hobbies->all());

        var_dump(json_encode($collection)); // "[{"name":"budhi","hobbies":["eating","running"]},{"name":"hasan","hobbies":["swiming","futsal"]},{"name":"budhi","hobbies":["rancing","reading"]}]"
        var_dump(json_encode($hobbies)); // "["eating","running","swiming","futsal","rancing","reading"]"


    }


}
