<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function osis(){
        $data = [
            [
                'id' => 1,
                'images' => [
                "assets/images/ps4_console_white_1.png",
                "assets/images/ps4_console_white_2.png",
                "assets/images/ps4_console_white_3.png",
                "assets/images/ps4_console_white_4.png",
                ],
                'colors' => [
                    '0xFFF6625E',
                    '0xFF836DB8',
                    '0xFFDECB9C',
                    'white',
                ],
                'title' => "Wireless Controller for PS4™",
                'price' => 64.99,
                'description' => '1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'rating' => 4.8,
                'isFavourite' => true,
                'isPopular' => true,
            ],
            [
                'id' => 2,
                'images' => [
                "assets/images/ps4_console_white_1.png",
                "assets/images/ps4_console_white_2.png",
                "assets/images/ps4_console_white_3.png",
                "assets/images/ps4_console_white_4.png",
                ],
                'colors' => [
                    '0xFFF6625E',
                    '0xFF836DB8',
                    '0xFFDECB9C',
                    'white',
                ],
                'title' => "Wireless Controller for PS4™",
                'price' => 64.99,
                'description' => '2 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'rating' => 4.8,
                'isFavourite' => true,
                'isPopular' => true,
            ],
            [
                'id' => 3,
                'images' => [
                "assets/images/ps4_console_white_1.png",
                "assets/images/ps4_console_white_2.png",
                "assets/images/ps4_console_white_3.png",
                "assets/images/ps4_console_white_4.png",
                ],
                'colors' => [
                    '0xFFF6625E',
                    '0xFF836DB8',
                    '0xFFDECB9C',
                    'white',
                ],
                'title' => "Wireless Controller for PS4™",
                'price' => 64.99,
                'description' => '3 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'rating' => 4.8,
                'isFavourite' => true,
                'isPopular' => true,
            ],
            [
                'id' => 4,
                'images' => [
                    "assets/images/ps4_console_white_1.png",
                    "assets/images/ps4_console_white_2.png",
                    "assets/images/ps4_console_white_3.png",
                    "assets/images/ps4_console_white_4.png",
                ],
                'colors' => [
                    '0xFFF6625E',
                    '0xFF836DB8',
                    '0xFFDECB9C',
                    'white',
                ],
                'title' => "Wireless Controller for PS4™",
                'price' => 64.99,
                'description' => '4 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'rating' => 4.8,
                'isFavourite' => true,
                'isPopular' => true,
            ],
        ];
        return response()->json($data);
    }
    public function sekolah(){
        $data = [
            [
                'id' => 1,
                'image' => 'assets/images/ps4_console_white_1.png',
                'description' => '1 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'category' => 'Fashion',
                'numOfBrands' => 18,
            ],
            [
                'id' => 2,
                'image' => 'assets/images/ps4_console_white_2.png',
                'description' => '2 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'category' => 'Smartphone',
                'numOfBrands' => 24,
            ],
            [
                'id' => 3,
                'image' => 'assets/images/ps4_console_white_3.png',
                'description' => '3 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'category' => 'Fashion',
                'numOfBrands' => 18,
            ],
        ];
        return response()->json($data);
    }
}
