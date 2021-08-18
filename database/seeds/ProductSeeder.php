<?php

use App\Services\ImportService;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ImportService $importService)
    {
        return $importService->import();
    }
}
