<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $story = [
            'title' => 'Petualangan Si Kancil',
            'author' => 'Penulis Cerita',
            'date' => '24 November 2025',
            'content' => [
                'Di sebuah hutan yang lebat, hiduplah seekor kancil yang cerdik dan lincah. Ia dikenal oleh seluruh penghuni hutan sebagai hewan yang paling cerdas.',

                'Suatu hari, Si Kancil sedang berjalan-jalan mencari makanan. Tiba-tiba, ia bertemu dengan seekor harimau yang lapar. Harimau itu langsung ingin memangsa Si Kancil.',

                '"Tunggu dulu, Pak Harimau!" kata Si Kancil dengan tenang. "Saya memang kecil, tetapi di dekat sini ada makanan yang jauh lebih besar dan lezat."',

                'Harimau itu penasaran dan bertanya, "Makanan apa itu? Tunjukkan padaku!"',

                'Si Kancil membawa harimau ke tepi sungai dan berkata, "Lihatlah ke dalam air itu. Ada harimau yang lebih besar sedang menjaga makanan yang banyak."',

                'Harimau yang bodoh itu mengintip ke dalam air dan melihat bayangannya sendiri. Dengan marah, ia langsung melompat ke dalam air untuk menyerang bayangannya. Harimau itu pun tenggelam dan terbawa arus.',

                'Si Kancil tersenyum dan berkata pada dirinya sendiri, "Kecerdikan lebih berharga daripada kekuatan." Ia pun melanjutkan perjalanannya dengan selamat.'
            ],
            'moral' => 'Kecerdikan dan kebijaksanaan lebih berharga daripada kekuatan fisik.'
        ];

        return view('story', compact('story'));
    }
}
