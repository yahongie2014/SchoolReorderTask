<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ReorderStudent extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function index()
    {
        Artisan::call('reorder:student');
    }
}
