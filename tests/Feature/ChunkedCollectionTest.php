<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChunkedCollectionTest extends TestCase
{
    /**
     * Chunked
     * ● Chunked adalah operasi untuk memotong collection menjadi beberapa collection
     *
     * Method               Keterangan
     * chunk(number)        Potong collection menjadi lebih kecil dimana tiap collection memiliki sejumlah total data number
     */

    public function testChunked()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $result = $collection->chunk(3); // chunk(size) // akan memecah menjadi beberapa collection memiliki sejumlah total data number

        $this->assertEqualsCanonicalizing([1, 2, 3], $result->all()[0]->all()); // all()[0]->all() // mengambil semua collection dari array index 0 yang sudah di pecah dari collection init
        $this->assertEqualsCanonicalizing([4, 5, 6], $result->all()[1]->all()); // all()[1]->all() // mengambil semua collection dari array index 1 yang sudah di pecah dari collection init
        $this->assertEqualsCanonicalizing([7, 8, 9], $result->all()[2]->all()); // all()[2]->all() // mengambil semua collection dari array index 2 yang sudah di pecah dari collection init
        $this->assertEqualsCanonicalizing([10], $result->all()[3]->all()); // all()[3]->all() // mengambil semua collection dari array index 3 yang sudah di pecah dari collection init

        var_dump(json_encode($result[0]));
        var_dump(json_encode($result[1]));
        var_dump(json_encode($result[2]));
        var_dump(json_encode($result[3]));

        /**
         * result:
         * string(7) "[1,2,3]"
         * string(19) "{"3":4,"4":5,"5":6}"
         * string(19) "{"6":7,"7":8,"8":9}"
         * string(8) "{"9":10}"
         */



    }

}
