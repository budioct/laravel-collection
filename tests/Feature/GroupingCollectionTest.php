<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupingCollectionTest extends TestCase
{
    /**
     * Grouping
     * ● Grouping adalah operasi untuk meng-grup kan element-element yang ada di collection.
     *
     * Method                   Keterangan
     * groupBy(key)             Menggabungkan data collection per key
     * groupBy(function)        Menggabungkan data collection per hasil function
     */

    public function testGroupingByKey()
    {
        $data = [
            [
                "name" => "budhi",
                "departement" => "IT",
            ],
            [
                "name" => "joko",
                "departement" => "IT",
            ],
            [
                "name" => "malik",
                "departement" => "HR",
            ],
        ];

        $collection = collect($data);
        $departement = $collection->groupBy("departement"); // groupBy(key_array) // Menggabungkan data collection per key
        $this->assertEquals([
            "IT" => collect([
                [
                    "name" => "budhi",
                    "departement" => "IT",
                ],
                [
                    "name" => "joko",
                    "departement" => "IT",
                ],
            ]),
            "HR" => collect([
                [
                    "name" => "malik",
                    "departement" => "HR",
                ],
            ])
        ], $departement->all());

        var_dump($collection);
        var_dump($departement);
        var_dump(json_encode($departement));

        /**
         * result:
         * string(122) "{"IT":[{"name":"budhi","departement":"IT"},{"name":"joko","departement":"IT"}],"HR":[{"name":"malik","departement":"HR"}]}"
         */

    }

    public function testGroupingByFunction()
    {

        $data = [
            [
                "name" => "budhi",
                "departement" => "IT",
            ],
            [
                "name" => "joko",
                "departement" => "IT",
            ],
            [
                "name" => "malik",
                "departement" => "HR",
            ],
        ];

        $collection = collect($data);
        $departement = $collection->groupBy(function ($item, $key) {
            return $item["departement"]; // $item adalah data dari collection // ["departement"] key dari data collection
        }); // groupBy(callback){}) // Menggabungkan data collection per hasil function

        $this->assertEquals([
            "IT" => collect([
                [
                    "name" => "budhi",
                    "departement" => "IT",
                ],
                [
                    "name" => "joko",
                    "departement" => "IT",
                ],
            ]),
            "HR" => collect([
                [
                    "name" => "malik",
                    "departement" => "HR",
                ],
            ])
        ], $departement->all());

        var_dump($collection);
        var_dump($departement);
        var_dump(json_encode($departement));

        /**
         * result:
         * string(122) "{"IT":[{"name":"budhi","departement":"IT"},{"name":"joko","departement":"IT"}],"HR":[{"name":"malik","departement":"HR"}]}"
         */

    }
}
