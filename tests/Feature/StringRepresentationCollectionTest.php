<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StringRepresentationCollectionTest extends TestCase
{
    /**
     * String Representation
     * ● String Representations adalah operasi transformasi untuk mengubah collection menjadi string
     *
     * Method                               Keterangan
     * join(glue = ‘’, finalGlue = ‘’)      Mengubah tiap item menjadi string dengan menggabungkan dengan separator glue, dan separator akhir finalGlue
     *
     * note: glue itu adalah pemisa/sparator item dengan item yang lain
     */

    public function testStringRepresentation()
    {

        $collection = collect(["budhi", "oct", "22"]);

        $this->assertEquals("budhi-oct-22", $collection->join("-")); // join() mengubah collection menjadi string
        $this->assertEquals("budhi-oct_22", $collection->join("-", "_"));
        $this->assertEquals("budhi, oct and 22", $collection->join(", ", " and "));

    }


}
