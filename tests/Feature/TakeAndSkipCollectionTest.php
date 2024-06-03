<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

class TakeAndSkipCollectionTest extends TestCase
{
    /**
     * Take & Skip
     * ● Untuk mengambil sebagian element di collection, selain menggunakan slice, kita juga bisa
     *   menggunakan operator take dan skip
     *
     * Method                       Keterangan
     * take(length)                 Mengambil data dari awal sepanjang length, jika length negative artinya proses mengambil dari posisi belakang
     * takeUntil(function)          Iterati tiap data, ambil tiap data sampai function mengembalikan nilai true
     * takeWhile(function)          Iterasi tiap data, ambil tiap data sampai function mengembalikan nilai false
     */

    public function testTake()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->take(3); // take(length_limit) // akan ambil data dari depan sampai panjang_limit

        assertEqualsCanonicalizing([1, 2, 3], $result->all());
        var_dump($result);

        /**
         * result:
         * array(3) {
         * [0]=> int(1)
         * [1]=> int(2)
         * [2]=> int(3)
         * }
         */

    }

    public function testTakeUtil()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->takeUntil(function ($item, $key) {
            return $item == 3;
        }); // takeUntil(closure) // Iterati tiap data, ambil tiap data sampai function mengembalikan nilai true, proses collect berhenti
        // $result = $collection->takeUntil(fn($item, $key) => $item == 3); // arrow function

        assertEqualsCanonicalizing([1, 2], $result->all());
        var_dump($result);

        /**
         * result
         * array(2) {
         * [0]=> int(1)
         * [1]=> int(2)
         * }
         */

    }

    public function testTakeWhile()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->takeWhile(function ($item, $key) {
            return $item < 5;
        }); // takeWhile(closure) // Iterasi tiap data, ambil tiap data sampai function mengembalikan nilai false, proses collect berhenti
        // $result = $collection->takeWhile(fn($item, $key) => $item < 5);

        assertEqualsCanonicalizing([1, 2, 3, 4], $result->all());
        var_dump($result);

        /**
         * result:
         * array(4) {
         * [0]=> int(1)
         * [1]=> int(2)
         * [2]=> int(3)
         * [3]=> int(4)
         * }
         */

    }

    /**
     * Method                   Keterangan
     * skip(length)             Ambil seluruh data kecuali sejumlah length data diawal
     * skipUntil(function)      Iterati tiap data, jangan ambil tiap data sampai function mengembalikan nilai true
     * skipWhile(function)      Iterasi tiap data, jangan ambil tiap data sampai function mengembalikan nilai false
     */

    public function testSkip()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->skip(3); // skip(length) // Ambil seluruh data kecuali sejumlah length data diawal

        $this->assertEqualsCanonicalizing([4, 5, 6, 7, 8, 9, 10], $result->all());
        var_dump($result);

        /**
         * result:
         * array(7) {
         * [3]=> int(4)
         * [4]=> int(5)
         * [5]=> int(6)
         * [6]=> int(7)
         * [7]=> int(8)
         * [8]=> int(9)
         * [9]=> int(10)
         * }
         */
    }

    public function testSkipUntil()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->SkipUntil(function ($item, $key) {
            return $item > 3;
        }); // skipUntil(closure) Iterati tiap data, jangan ambil tiap data sampai function mengembalikan nilai true, proses collect berhenti
        // $result = $collection->SkipUntil(fn($item, $key) => $item == 3); // method arrow

        $this->assertEqualsCanonicalizing([4, 5, 6, 7, 8, 9, 10], $result->all());
        var_dump($result);

        /**
         * result:
         * array(7) {
         * [3]=> int(4)
         * [4]=> int(5)
         * [5]=> int(6)
         * [6]=> int(7)
         * [7]=> int(8)
         * [8]=> int(9)
         * [9]=> int(10)
         * }
         */
    }

    public function testSkipWhile()
    {

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $result = $collection->SkipWhile(function ($item, $key) {
            return $item < 3;
        }); // skipWhile(closure) // Iterasi tiap data, jangan ambil tiap data sampai function mengembalikan nilai false
        // $result = $collection->SkipWhile(fn($item, $key) => $item == 3); // method arrow

        $this->assertEqualsCanonicalizing([3, 4, 5, 6, 7, 8, 9, 10], $result->all());
        var_dump($result);

        /**
         * result:
         * array(7) {
         * [2]=> int(4)
         * [3]=> int(4)
         * [4]=> int(5)
         * [5]=> int(6)
         * [6]=> int(7)
         * [7]=> int(8)
         * [8]=> int(9)
         * [9]=> int(10)
         * }
         */
    }

}
