<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ReduceCollection extends TestCase
{
    /**
     * Reduce
     * ● Jika kita ingin membuat aggregate secara manual, kita bisa menggunakan function reduce
     * ● Reduce merupakan operasi yang dilakukan pada tiap data yang ada di collection secara sequential
     *   dan mengembalikan hasil
     * ● Hasil dari reduce sebelumnya akan digunakan di iterasi selanjutnya
     *
     * Method                               Keterangan
     * reduce(function(carry, item))        Pada iterasi pertama, carry akan bernilai data
     *                                      pertama, dan item adalah data selanjutnya.......
     *                                      Pada iterasi selanjutnya, carry adalah hasil dari
     *                                      iterasi sebelumnya.
     */

    public function testReduce()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->reduce(function ($carry, $item) {
            return $carry + $item; // setiap perulangan akan selalu di tambah sampai akhir panjang array
        });

        $this->assertEquals(55, $result);

        /**
         * // setiap perulangan akan value akan di tambah value berikutnya sampai panjang array habis
         * cara kerja nya reduce
         * reduce(1,2) = 3
         * reduce(3,3) = 6
         * reduce(6,4) = 10
         * reduce(10,5) = 15
         * reduce(15,6) = 21
         * reduce(21,7) = 28
         * reduce(28,8) = 36
         * reduce(36,9) = 45
         * reduce(45,10) = 55
         */

    }
}
