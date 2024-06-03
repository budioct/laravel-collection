<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestingCollectionTest extends TestCase
{
    /**
     * Testing
     * ● Testing adalah operasi untuk mengecek isi data di collection
     * ● Hasil dari testing adalah boolean, dimana true jika sesuai kondisi, dan false jika tidak sesuai kondisi
     *
     * Method                         Keterangan
     * has(array):bool                Mengecek apakah collection memiliki semua key data
     * hasAny(array):bool             Mengecek apakah collection memiliki salah satu key data
     * contains(value):bool           Mengecek apakah collection memiliki data value
     * contains(key, value):bool      Mengecek apakah collection memiliki data key dengan value
     * contains(function):bool        Iterasi tiap data, mengirim ke function dan mengecek apakah salah satu data menghasilkan true
     */

    public function testTestingCollection()
    {

        $data = array("budhi", "octaviansyah", "22");
        $collection = collect($data);

        $this->assertTrue($collection->contains("budhi"));
        $this->assertTrue($collection->contains(function ($item, $key) {
            return $item == "budhi";
        }));

    }

}
