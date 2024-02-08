<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Caminho para o arquivo CSV
        $csvPath = database_path('seeders/products.csv');

        // Abre o arquivo CSV
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Define que a primeira linha contém os cabeçalhos
        $csv->setDelimiter(';');
        // Processa cada linha do arquivo CSV
        foreach ($csv as $record) {

            DB::table('products')->insert([
                'name' => $record['name'],
                'size' => $record['size'],
                'brand' => $record['brand'],
                'price' => $record['price'],
            ]);
        }
    }
}
