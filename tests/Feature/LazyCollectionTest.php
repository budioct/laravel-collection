<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\LazyCollection;
use Tests\TestCase;

class LazyCollectionTest extends TestCase
{

    /**
     * Lazy Collection
     * ● Saat belajar PHP, kita pernah membuat Generator (Lazy Array/Iterable)
     * ● Di Laravel juga kita bisa membuat hal seperti itu, bernama Lazy Collection
     * ● Keuntungan menggunakan Lazy Collection adalah kita bisa melakukan manipulasi data besar,
     *   tanpa harus takut semua operasi dieksekusi sebelum dibutuhkan
     * ● Saat membuat Lazy Collection, kita perlu menggunakan PHP Generator
     * ● https://laravel.com/api/10.x/Illuminate/Support/LazyCollection.html
     */

    public function testLazyCollection()
    {

        $collection = LazyCollection::make(function () {
            $value = 0;
            while (true) {
                yield $value;
                $value++;
            }
        });

        $result = $collection->take(10); // take(length_limit) // akan ambil data dari depan sampai panjang_limit
        self::assertEqualsCanonicalizing([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $result->all());

        var_dump(json_encode($result));
    }

}
