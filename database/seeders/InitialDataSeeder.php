<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // ----- Categories -----
        Category::insert([
            ['name' => 'Lady'],
            ['name' => 'Men'],
        ]);

        // ----- Colors -----
        Color::insert([
            ['name' => 'Red'],
            ['name' => 'Blue'],
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Pink'],
            ['name' => 'Brown'],
            ['name' => 'Olive Green'],
            ['name' => 'Light Blue'],
            ['name' => 'Navy Blue'],
            ['name' => 'Beige'],
            ['name' => 'Dark Green'],
            ['name' => 'Dark Gray'],
            ['name' => 'Light Green'],
        ]);

        // ----- Sizes -----
        Size::insert([
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
        ]);

        // Get color and size IDs by name for easy reference
        $colorIds = Color::pluck('id', 'name')->toArray();
        $sizeIds = Size::pluck('id', 'name')->toArray();

        // ----- Lady Products -----
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cami Mini Dress Light Blue',
            'description' => 'Light blue cami mini dress, perfect for summer.',
            'price' => 39.99,
            'main_image' => 'img/Lady/Cami Mini Dress/Light Blue/main.jpg',
            'front_image' => 'img/Lady/Cami Mini Dress/Light Blue/front.jpg',
            'back_image' => 'img/Lady/Cami Mini Dress/Light Blue/back.jpg',
            'side_image' => 'img/Lady/Cami Mini Dress/Light Blue/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Light Blue'], $colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cami Mini Dress White',
            'description' => 'White cami mini dress.',
            'price' => 39.99,
            'main_image' => 'img/Lady/Cami Mini Dress/white/main.jpg',
            'front_image' => 'img/Lady/Cami Mini Dress/white/front.jpg',
            'back_image' => 'img/Lady/Cami Mini Dress/white/back.jpg',
            'side_image' => 'img/Lady/Cami Mini Dress/white/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['L']]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Crop Sweat Jacket Black',
            'description' => 'Black crop sweat jacket.',
            'price' => 29.99,
            'main_image' => 'img/Lady/Crop Sweat Jacket/Black/main.jpg',
            'front_image' => 'img/Lady/Crop Sweat Jacket/Black/front.jpg',
            'back_image' => 'img/Lady/Crop Sweat Jacket/Black/back.jpg',
            'side_image' => 'img/Lady/Crop Sweat Jacket/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Crop Sweat Jacket White',
            'description' => 'White crop sweat jacket.',
            'price' => 29.99,
            'main_image' => 'img/Lady/Crop Sweat Jacket/White/main.jpg',
            'front_image' => 'img/Lady/Crop Sweat Jacket/White/front.jpg',
            'back_image' => 'img/Lady/Crop Sweat Jacket/White/back.jpg',
            'side_image' => 'img/Lady/Crop Sweat Jacket/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cropped T-shirt With Print Blue Wash',
            'description' => 'Blue wash cropped t-shirt with print.',
            'price' => 19.99,
            'main_image' => 'img/Lady/Cropped T-shirt With Print/Blue Wash/main.jpg',
            'front_image' => 'img/Lady/Cropped T-shirt With Print/Blue Wash/front.jpg',
            'back_image' => 'img/Lady/Cropped T-shirt With Print/Blue Wash/back.jpg',
            'side_image' => 'img/Lady/Cropped T-shirt With Print/Blue Wash/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Blue'], $colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cropped T-shirt With Print Olive Green',
            'description' => 'Olive green cropped t-shirt with print.',
            'price' => 19.99,
            'main_image' => 'img/Lady/Cropped T-shirt With Print/Olive Green/main.jpg',
            'front_image' => 'img/Lady/Cropped T-shirt With Print/Olive Green/front.jpg',
            'back_image' => 'img/Lady/Cropped T-shirt With Print/Olive Green/back.jpg',
            'side_image' => 'img/Lady/Cropped T-shirt With Print/Olive Green/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Olive Green']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cropped T-Shirt With Print1 Navy',
            'description' => 'Navy cropped t-shirt with print.',
            'price' => 19.99,
            'main_image' => 'img/Lady/Cropped T-Shirt With Print1/navy/main.jpg',
            'front_image' => 'img/Lady/Cropped T-Shirt With Print1/navy/front.jpg',
            'back_image' => 'img/Lady/Cropped T-Shirt With Print1/navy/back.jpg',
            'side_image' => 'img/Lady/Cropped T-Shirt With Print1/navy/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Navy Blue']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Cropped T-Shirt With Print1 Red',
            'description' => 'Red cropped t-shirt with print.',
            'price' => 19.99,
            'main_image' => 'img/Lady/Cropped T-Shirt With Print1/Red/main.jpg',
            'front_image' => 'img/Lady/Cropped T-Shirt With Print1/Red/front.jpg',
            'back_image' => 'img/Lady/Cropped T-Shirt With Print1/Red/back.jpg',
            'side_image' => 'img/Lady/Cropped T-Shirt With Print1/Red/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Red']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Midi Dress Black',
            'description' => 'Black midi dress.',
            'price' => 44.99,
            'main_image' => 'img/Lady/Midi Dress/Black/main.jpg',
            'front_image' => 'img/Lady/Midi Dress/Black/front.jpg',
            'back_image' => 'img/Lady/Midi Dress/Black/back.jpg',
            'side_image' => 'img/Lady/Midi Dress/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Midi Dress Pink',
            'description' => 'Pink midi dress.',
            'price' => 44.99,
            'main_image' => 'img/Lady/Midi Dress/Pink/main.jpg',
            'front_image' => 'img/Lady/Midi Dress/Pink/front.jpg',
            'back_image' => 'img/Lady/Midi Dress/Pink/back.jpg',
            'side_image' => 'img/Lady/Midi Dress/Pink/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Pink']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Off Shoulder T-Shirt Black',
            'description' => 'Black off shoulder t-shirt.',
            'price' => 22.99,
            'main_image' => 'img/Lady/Off Shoulder T-Shirt/Black/main.jpg',
            'front_image' => 'img/Lady/Off Shoulder T-Shirt/Black/front.jpg',
            'back_image' => 'img/Lady/Off Shoulder T-Shirt/Black/back.jpg',
            'side_image' => 'img/Lady/Off Shoulder T-Shirt/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Off Shoulder T-Shirt White',
            'description' => 'White off shoulder t-shirt.',
            'price' => 22.99,
            'main_image' => 'img/Lady/Off Shoulder T-Shirt/White/main.jpg',
            'front_image' => 'img/Lady/Off Shoulder T-Shirt/White/front.jpg',
            'back_image' => 'img/Lady/Off Shoulder T-Shirt/White/back.jpg',
            'side_image' => 'img/Lady/Off Shoulder T-Shirt/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'T-Shirt With Print Light Pink',
            'description' => 'Light pink t-shirt with print.',
            'price' => 18.99,
            'main_image' => 'img/Lady/T-Shirt With Print/Light Pink/main.jpg',
            'front_image' => 'img/Lady/T-Shirt With Print/Light Pink/front.jpg',
            'back_image' => 'img/Lady/T-Shirt With Print/Light Pink/back.jpg',
            'side_image' => 'img/Lady/T-Shirt With Print/Light Pink/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Pink']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'T-Shirt With Print White',
            'description' => 'White t-shirt with print.',
            'price' => 18.99,
            'main_image' => 'img/Lady/T-Shirt With Print/White/main.jpg',
            'front_image' => 'img/Lady/T-Shirt With Print/White/front.jpg',
            'back_image' => 'img/Lady/T-Shirt With Print/White/back.jpg',
            'side_image' => 'img/Lady/T-Shirt With Print/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Wide Leg Sweatpants Black',
            'description' => 'Black wide leg sweatpants.',
            'price' => 27.99,
            'main_image' => 'img/Lady/Wide Leg Sweatpants/Black/main.jpg',
            'front_image' => 'img/Lady/Wide Leg Sweatpants/Black/front.jpg',
            'back_image' => 'img/Lady/Wide Leg Sweatpants/Black/back.jpg',
            'side_image' => 'img/Lady/Wide Leg Sweatpants/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 1,
            'name' => 'Wide Leg Sweatpants White',
            'description' => 'White wide leg sweatpants.',
            'price' => 27.99,
            'main_image' => 'img/Lady/Wide Leg Sweatpants/White/main.jpg',
            'front_image' => 'img/Lady/Wide Leg Sweatpants/White/front.jpg',
            'back_image' => 'img/Lady/Wide Leg Sweatpants/White/back.jpg',
            'side_image' => 'img/Lady/Wide Leg Sweatpants/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        // ----- Men Products -----
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Basketbal T-Shirt With Print Navy Blue',
            'description' => 'Navy blue basketball t-shirt with print.',
            'price' => 21.99,
            'main_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Navy Blue/main.jpg',
            'front_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Navy Blue/front.jpg',
            'back_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Navy Blue/back.jpg',
            'side_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Navy Blue/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Navy Blue']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Basketbal T-Shirt With Print Red',
            'description' => 'Red basketball t-shirt with print.',
            'price' => 21.99,
            'main_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Red/main.jpg',
            'front_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Red/front.jpg',
            'back_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Red/back.jpg',
            'side_image' => 'img/Men/Basketbal_T-Shirt_Wit_Print/Red/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Red']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Hoody Black',
            'description' => 'Black men\'s hoody.',
            'price' => 34.99,
            'main_image' => 'img/Men/hoody/Black/main.jpg',
            'front_image' => 'img/Men/hoody/Black/front.jpg',
            'back_image' => 'img/Men/hoody/Black/back.jpg',
            'side_image' => 'img/Men/hoody/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Hoody Brown',
            'description' => 'Brown men\'s hoody.',
            'price' => 34.99,
            'main_image' => 'img/Men/hoody/Brown/main.jpg',
            'front_image' => 'img/Men/hoody/Brown/front.jpg',
            'back_image' => 'img/Men/hoody/Brown/back.jpg',
            'side_image' => 'img/Men/hoody/Brown/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Brown']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Hoody White',
            'description' => 'White men\'s hoody.',
            'price' => 34.99,
            'main_image' => 'img/Men/hoody/white/main.jpg',
            'front_image' => 'img/Men/hoody/white/front.jpg',
            'back_image' => 'img/Men/hoody/white/back.jpg',
            'side_image' => 'img/Men/hoody/white/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Shorts With Print Beige',
            'description' => 'Beige shorts with print.',
            'price' => 17.99,
            'main_image' => 'img/Men/Shorts_With_Print/Beige/main.jpg',
            'front_image' => 'img/Men/Shorts_With_Print/Beige/front.jpg',
            'back_image' => 'img/Men/Shorts_With_Print/Beige/back.jpg',
            'side_image' => 'img/Men/Shorts_With_Print/Beige/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Beige']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Shorts With Print Black',
            'description' => 'Black shorts with print.',
            'price' => 17.99,
            'main_image' => 'img/Men/Shorts_With_Print/Black/main.jpg',
            'front_image' => 'img/Men/Shorts_With_Print/Black/front.jpg',
            'back_image' => 'img/Men/Shorts_With_Print/Black/back.jpg',
            'side_image' => 'img/Men/Shorts_With_Print/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Shorts With Print Navy Blue',
            'description' => 'Navy blue shorts with print.',
            'price' => 17.99,
            'main_image' => 'img/Men/Shorts_With_Print/navy Blue/main.jpg',
            'front_image' => 'img/Men/Shorts_With_Print/navy Blue/front.jpg',
            'back_image' => 'img/Men/Shorts_With_Print/navy Blue/back.jpg',
            'side_image' => 'img/Men/Shorts_With_Print/navy Blue/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Navy Blue']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Straight Fit Shorts Beige',
            'description' => 'Beige straight fit shorts.',
            'price' => 19.99,
            'main_image' => 'img/Men/Straight_Fit Shorts/Beige/main.jpg',
            'front_image' => 'img/Men/Straight_Fit Shorts/Beige/front.jpg',
            'back_image' => 'img/Men/Straight_Fit Shorts/Beige/back.jpg',
            'side_image' => 'img/Men/Straight_Fit Shorts/Beige/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Beige']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Straight Fit Shorts Dark Green',
            'description' => 'Dark green straight fit shorts.',
            'price' => 19.99,
            'main_image' => 'img/Men/Straight_Fit Shorts/Dark Green/main.jpg',
            'front_image' => 'img/Men/Straight_Fit Shorts/Dark Green/front.jpg',
            'back_image' => 'img/Men/Straight_Fit Shorts/Dark Green/back.jpg',
            'side_image' => 'img/Men/Straight_Fit Shorts/Dark Green/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Dark Green']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'T-Shirt Black',
            'description' => 'Black men\'s t-shirt.',
            'price' => 14.99,
            'main_image' => 'img/Men/T-Shirt/Black/main.jpg',
            'front_image' => 'img/Men/T-Shirt/Black/front.jpg',
            'back_image' => 'img/Men/T-Shirt/Black/back.jpg',
            'side_image' => 'img/Men/T-Shirt/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'T-Shirt Dark Gray',
            'description' => 'Dark gray men\'s t-shirt.',
            'price' => 14.99,
            'main_image' => 'img/Men/T-Shirt/Dark_Gray/main.jpg',
            'front_image' => 'img/Men/T-Shirt/Dark_Gray/front.jpg',
            'back_image' => 'img/Men/T-Shirt/Dark_Gray/back.jpg',
            'side_image' => 'img/Men/T-Shirt/Dark_Gray/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Dark Gray']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'T-Shirt White',
            'description' => 'White men\'s t-shirt.',
            'price' => 14.99,
            'main_image' => 'img/Men/T-Shirt/White/main.jpg',
            'front_image' => 'img/Men/T-Shirt/White/front.jpg',
            'back_image' => 'img/Men/T-Shirt/White/back.jpg',
            'side_image' => 'img/Men/T-Shirt/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'T-Shirt With Print Light Green',
            'description' => 'Light green t-shirt with print.',
            'price' => 16.99,
            'main_image' => 'img/Men/T-Shirt_With_Print/light Green/main.jpg',
            'front_image' => 'img/Men/T-Shirt_With_Print/light Green/front.jpg',
            'back_image' => 'img/Men/T-Shirt_With_Print/light Green/back.jpg',
            'side_image' => 'img/Men/T-Shirt_With_Print/light Green/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Light Green']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['L']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'T-Shirt With Print White',
            'description' => 'White t-shirt with print.',
            'price' => 16.99,
            'main_image' => 'img/Men/T-Shirt_With_Print/White/main.jpg',
            'front_image' => 'img/Men/T-Shirt_With_Print/White/front.jpg',
            'back_image' => 'img/Men/T-Shirt_With_Print/White/back.jpg',
            'side_image' => 'img/Men/T-Shirt_With_Print/White/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['White']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Tank Top With Print Beige',
            'description' => 'Beige tank top with print.',
            'price' => 12.99,
            'main_image' => 'img/Men/Tank_Top_With_ Print/Beige/main.jpg',
            'front_image' => 'img/Men/Tank_Top_With_ Print/Beige/front.jpg',
            'back_image' => 'img/Men/Tank_Top_With_ Print/Beige/back.jpg',
            'side_image' => 'img/Men/Tank_Top_With_ Print/Beige/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Beige']]);
        $product->sizes()->attach([$sizeIds['S'], $sizeIds['M']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Tank Top With Print Black',
            'description' => 'Black tank top with print.',
            'price' => 12.99,
            'main_image' => 'img/Men/Tank_Top_With_ Print/Black/main.jpg',
            'front_image' => 'img/Men/Tank_Top_With_ Print/Black/front.jpg',
            'back_image' => 'img/Men/Tank_Top_With_ Print/Black/back.jpg',
            'side_image' => 'img/Men/Tank_Top_With_ Print/Black/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Black']]);
        $product->sizes()->attach([$sizeIds['L'], $sizeIds['XL']]);
        $product = Product::create([
            'category_id' => 2,
            'name' => 'Tank Top With Print Navy Blue',
            'description' => 'Navy blue tank top with print.',
            'price' => 12.99,
            'main_image' => 'img/Men/Tank_Top_With_ Print/Navy Blue/main.jpg',
            'front_image' => 'img/Men/Tank_Top_With_ Print/Navy Blue/front.jpg',
            'back_image' => 'img/Men/Tank_Top_With_ Print/Navy Blue/back.jpg',
            'side_image' => 'img/Men/Tank_Top_With_ Print/Navy Blue/side.jpg',
        ]);
        $product->colors()->attach([$colorIds['Navy Blue']]);
        $product->sizes()->attach([$sizeIds['M'], $sizeIds['L']]);
    }
}