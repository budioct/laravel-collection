<?php

namespace Tests\Feature;

use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

class MapCollectionTest extends TestCase
{

    /**
     * Mapping
     * ● Mapping adalah transformasi (mengubah bentuk data) menjadi data lain
     * ● Mapping membutuhkan function sebagai parameter yang digunakan untuk membentuk data lainnya
     * ● Urutan Collection hasil mapping adalah sama dengan urutan collection aslinya
     *
     * Mapping Operations
     * Method                        Keterangan
     * map(function)                Iterasi seluruh data, dan mengirim seluruh data ke function
     * mapInto(class)               Iterasi seluruh data, dan membuat object baru untuk class dengan mengirim parameter tiap data
     * mapSpread(function)          Iterasi seluruh data, dan mengirim tiap data sebagai parameter di function
     * mapToGroups(function)        Iterasi seluruh data, dan mengirim tiap data ke function, function harus mengembalikan single key-value array untuk di group sebagai collection baru
     *
     * ini adalah transform/mapping/tranformasi yaitu mengubah dari satu bentuk data menjadi data yang lain
     * note: // hasil map harus mengembalikan collection baru
     */

    public function testMap()
    {
        // map(function) Iterasi seluruh data, dan mengirim seluruh data ke function

        $collection = collect([1, 2, 3]);

        // map(callback_function(data_dari_collection){
        // proses olah data di sini
        // })
        $result = $collection->map(function ($item) {
            return $item * 2;
        });

        $this->assertEqualsCanonicalizing([2, 4, 6], $result->all());
         var_dump(json_encode($collection));
         var_dump(json_encode($result));

        /**
         * result:
         * string(7) "[1,2,3]"
         * string(7) "[2,4,6]"
         */

    }

    public function testMapInto()
    {
        // mapInto(class) Iterasi seluruh data, dan membuat object baru untuk class dengan mengirim parameter tiap data

        $collection = collect(["budhi"]);

        $result = $collection->mapInto(Person::class);

        $this->assertEquals([new Person('budhi')], $result->all());
        var_dump(json_encode($collection));
        var_dump(json_encode($result));

        /**
         * result:
         * string(9) "["budhi"]"
         * string(18) "[{"name":"budhi"}]"
         */

    }

    public function testMapSpread()
    {
        // mapSpread(function) Iterasi seluruh data, dan mengirim tiap data sebagai parameter di function

        // mengirim collection data dalam array dan manipulasi index pertama dan index dua di gabung dengan new instance ke class Person
        $collection = collect([
            ["budhi", "octaviansyah"],
            ["marzuki", "iskandar"],
            ["deden", "prayitna"],
        ]);

        $result = $collection->mapSpread(function ($firstName, $lastName) {
            $fullName = $firstName . " " . $lastName;
            return new Person($fullName);
        });

        $this->assertEquals([
            new Person("budhi octaviansyah"),
            new Person("marzuki iskandar"),
            new Person("deden prayitna"),
        ], $result->all());
        var_dump(json_encode($collection));
        var_dump(json_encode($result));

        /**
         * result:
         * string(70) "[["budhi","octaviansyah"],["marzuki","iskandar"],["deden","prayitna"]]"
         * string(85) "[{"name":"budhi octaviansyah"},{"name":"marzuki iskandar"},{"name":"deden prayitna"}]"
         */

    }

    public function testMapToGroups(){

        // mapToGroups(function) Iterasi seluruh data, dan mengirim tiap data ke function, function harus mengembalikan single key-value array untuk di group sebagai collection baru
        $collection = collect([
            [
                "name" => "budhi",
                "departement" => "IT"
            ],
            [
                "name" => "jamal",
                "departement" => "IT"
            ],
            [
                "name" => "asep",
                "departement" => "HR"
            ],
        ]);

        $result = $collection->mapToGroups(function ($person){
            return [
                $person["departement"] => $person["name"]
            ]; // yang key dari array assosiative nya sama akan di gabung menjadi satu
        });

        $this->assertEquals([
            "IT" => collect(["budhi", "jamal"]),
            "HR" => collect(["asep"])
        ], $result->all());
        var_dump(json_encode($collection));
        var_dump(json_encode($result));

        /**
         * result:
         * string(108) "[{"name":"budhi","departement":"IT"},{"name":"jamal","departement":"IT"},{"name":"asep","departement":"HR"}]"
         * string(38) "{"IT":["budhi","jamal"],"HR":["asep"]}"
         */

    }

}
