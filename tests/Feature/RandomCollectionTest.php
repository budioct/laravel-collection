<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RandomCollectionTest extends TestCase
{
    /**
     * Random
     * ● Random adalah operasi untuk mengambil data di collection dengan posisi random
     *
     * Method               Keterangan
     * random()             Mengambil satu data collection dengan posisi random
     * random(total)        Mengambil sejumlah total data collection dengan posisi random
     */

    public function testRandom(){

        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $random = $collection->random(); // random() // akan mengambil value random dari collection
        $this->assertTrue(in_array($random, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])); // check apakah value ada dalam array

    }

}
