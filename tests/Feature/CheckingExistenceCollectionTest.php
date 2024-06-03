<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckingExistenceCollectionTest extends TestCase
{
    /**
     * Checking Existence
     * ● Checking Existence merupakan operasi untuk mengecek apakah terdapat data yang dicari di Collection
     *
     * Method                         Keterangan
     * isEmpty() : bool               Mengecek apakah collection kosong
     * isNotEmpty()                   Mengecek apakah collection tidak kosong
     * contains(value)                Mengecek apakah collection memiliki value
     * contains(function)             Mengecek apakah collection memiliki value dengan kondisi function yang menghasilkan true
     * containsOneItem()              Mengecek apakah collection hanya memiliki satu data
     */

    public function testCheckingExistence(){

        $collection = collect(["budhi", "octaviansyah", "malik", "joko"]);
        self::assertFalse($collection->isEmpty()); // isEmpty() // false karna collection sebenarnya tidak kosong
        self::assertTrue($collection->isNotEmpty()); // isNotEmpty() // true karna collection tidak kosong
        self::assertTrue($collection->contains("budhi")); // contains(value) // true karna value ada di dalam collection
        self::assertFalse($collection->contains("jamal")); // contains(value) // false karna value tidak ada di dalam collection
        self::assertTrue($collection->contains(function ($value, $key) {
            return $value === "budhi";
        })); // contains(closure(){}) // true karna value ada dalam collection
        self::assertFalse($collection->contains(function ($value, $key) {
            return $value === "ismat";
        })); // contains(closure(){}) // false karna value tidak ada dalam collection
        self::assertFalse($collection->containsOneItem()); // containsOneItem() // false karna collection lebih dari satu data


    }

}
