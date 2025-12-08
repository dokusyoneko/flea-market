<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'user_id' => 1,
            'name' => '腕時計',
            'brand' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => 15000,
            'condition' => '良好',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'HDD',
            'brand' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'price' => 5000,
            'condition' => '目立った傷や汚れなし',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => '玉ねぎ3束',
            'brand' => 'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'price' => 300,
            'condition' => 'やや傷や汚れあり',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => '革靴',
            'brand' => '',
            'description' => 'クラシックなデザインの革靴',
            'price' => 4000,
            'condition' => '状態が悪い',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'ノートPC',
            'brand' => '',
            'description' => '高性能なノートパソコン',
            'price' => 45000,
            'condition' => '良好',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'マイク',
            'brand' => 'なし',
            'description' => '高音質のレコーディング用マイク',
            'price' => 8000,
            'condition' => '目立った傷や汚れなし',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'ショルダーバッグ',
            'brand' => '',
            'description' => 'おしゃれなショルダーバッグ',
            'price' => 3500,
            'condition' => 'やや傷や汚れあり',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'タンブラー',
            'brand' => 'なし',
            'description' => '使いやすいタンブラー',
            'price' => 500,
            'condition' => '状態が悪い',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'コーヒーミル',
            'brand' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'price' => 4000,
            'condition' => '良好',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
        ]);

        Product::create([
            'user_id' => 1,
            'name' => 'メイクセット',
            'brand' => '',
            'description' => '便利なメイクアップセット',
            'price' => 2500,
            'condition' => '目立った傷や汚れなし',
            'is_sold' => false,
            'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
        ]);
    }
}
