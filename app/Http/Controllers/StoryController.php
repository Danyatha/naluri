<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoryController extends Controller
{
    private function getAllStories()
    {
        return [
            [
                'id' => 1,
                'title' => 'Petualangan Si Kancil',
                'slug' => 'petualangan-si-kancil',
                'category' => 'Fabel',
                'author' => 'Admin Cerita',
                'date' => '24 November 2025',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800',
                'excerpt' => 'Di sebuah hutan yang lebat, hiduplah seekor kancil yang cerdik dan lincah. Ia dikenal oleh seluruh penghuni hutan sebagai hewan yang paling cerdas.',
                'content' => [
                    'Di sebuah hutan yang lebat, hiduplah seekor kancil yang cerdik dan lincah. Ia dikenal oleh seluruh penghuni hutan sebagai hewan yang paling cerdas.',
                    'Suatu hari, Si Kancil sedang berjalan-jalan mencari makanan. Tiba-tiba, ia bertemu dengan seekor harimau yang lapar. Harimau itu langsung ingin memangsa Si Kancil.',
                    '"Tunggu dulu, Pak Harimau!" kata Si Kancil dengan tenang. "Saya memang kecil, tetapi di dekat sini ada makanan yang jauh lebih besar dan lezat."',
                    'Harimau itu penasaran dan bertanya, "Makanan apa itu? Tunjukkan padaku!"',
                    'Si Kancil membawa harimau ke tepi sungai dan berkata, "Lihatlah ke dalam air itu. Ada harimau yang lebih besar sedang menjaga makanan yang banyak."',
                    'Harimau yang bodoh itu mengintip ke dalam air dan melihat bayangannya sendiri. Dengan marah, ia langsung melompat ke dalam air untuk menyerang bayangannya. Harimau itu pun tenggelam dan terbawa arus.',
                    'Si Kancil tersenyum dan berkata pada dirinya sendiri, "Kecerdikan lebih berharga daripada kekuatan." Ia pun melanjutkan perjalanannya dengan selamat.'
                ],
                'moral' => 'Kecerdikan dan kebijaksanaan lebih berharga daripada kekuatan fisik.',
                'views' => '1.2K',
                'reading_time' => '5 min'
            ],
            [
                'id' => 2,
                'title' => 'Legenda Gunung Tangkuban Perahu',
                'slug' => 'legenda-tangkuban-perahu',
                'category' => 'Legenda',
                'author' => 'Penulis Nusantara',
                'date' => '23 November 2025',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'excerpt' => 'Kisah tragis Sangkuriang yang jatuh cinta pada ibunya sendiri tanpa menyadarinya, melahirkan legenda gunung yang terkenal.',
                'content' => [
                    'Di Jawa Barat, terdapat sebuah gunung yang bentuknya seperti perahu terbalik. Gunung ini bernama Tangkuban Perahu. Konon, gunung ini terbentuk dari sebuah perahu yang ditendang oleh seorang pemuda bernama Sangkuriang.',
                    'Dahulu kala, hiduplah seorang putri cantik bernama Dayang Sumbi. Suatu hari, ia sedang menenun dan tidak sengaja menjatuhkan teropongnya. Ia bersumpah akan menikahi siapa pun yang mengambilkannya.',
                    'Seekor anjing bernama Tumang mengambilkan teropong itu. Karena sumpahnya, Dayang Sumbi terpaksa menikahi Tumang. Mereka dikaruniai seorang anak bernama Sangkuriang.',
                    'Sangkuriang tidak tahu bahwa Tumang adalah ayahnya. Suatu hari, ia membunuh Tumang karena kegagalan berburu. Dayang Sumbi sangat marah dan memukul kepala Sangkuriang hingga berbekas. Sangkuriang pun pergi meninggalkan ibunya.',
                    'Bertahun-tahun kemudian, Sangkuriang yang telah dewasa bertemu dengan seorang wanita cantik yang ternyata adalah ibunya sendiri. Mereka saling jatuh cinta tanpa mengenali satu sama lain.',
                    'Ketika Dayang Sumbi menyadari luka di kepala Sangkuriang, ia tahu bahwa pemuda itu adalah anaknya. Untuk menggagalkan pernikahan, ia memberikan syarat mustahil: membuat perahu dan bendungan dalam semalam.',
                    'Sangkuriang hampir berhasil. Dayang Sumbi pun meminta penduduk menumbuk lesung dan menebarkan kain merah di timur untuk membuat ayam berkokok, pertanda fajar. Sangkuriang yang marah menendang perahu hingga terbalik, membentuk Gunung Tangkuban Perahu.'
                ],
                'moral' => 'Kesabaran dan kontrol emosi sangat penting dalam menghadapi kekecewaan.',
                'views' => '2.5K',
                'reading_time' => '7 min'
            ],
            [
                'id' => 3,
                'title' => 'Malin Kundang Si Anak Durhaka',
                'slug' => 'malin-kundang',
                'category' => 'Legenda',
                'author' => 'Cerita Rakyat',
                'date' => '22 November 2025',
                'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
                'excerpt' => 'Kisah seorang anak yang mengingkari ibunya setelah menjadi kaya raya, hingga dikutuk menjadi batu.',
                'content' => [
                    'Di sebuah kampung nelayan di pesisir Sumatra Barat, hiduplah seorang janda miskin bersama anaknya yang bernama Malin Kundang. Mereka hidup dalam kesederhanaan.',
                    'Malin Kundang bertekad untuk mengubah nasib. Ia meminta izin ibunya untuk merantau mencari pekerjaan. Dengan berat hati, sang ibu melepas kepergian anaknya.',
                    'Di tanah rantau, Malin bekerja keras dan akhirnya menjadi seorang pedagang sukses. Ia menikah dengan putri saudagar kaya dan hidup dalam kemewahan.',
                    'Suatu hari, kapal Malin Kundang berlabuh di kampung halamannya. Sang ibu yang sudah tua mendengar kabar kepulangan anaknya. Dengan penuh harap, ia menyambut Malin di pelabuhan.',
                    'Namun Malin Kundang malu mengakui ibunya yang miskin dan compang-camping. Ia menolak keras dan bahkan mendorong ibunya hingga jatuh.',
                    'Sang ibu yang patah hati mengangkat tangan ke langit dan berdoa, "Ya Tuhan, jika dia benar-benar anakku, hukumlah dia!" Tiba-tiba langit mendung dan badai datang.',
                    'Malin Kundang beserta kapalnya terkena badai. Tubuhnya perlahan berubah menjadi batu. Hingga kini, batu Malin Kundang masih bisa dilihat di pantai Air Manis, Padang.'
                ],
                'moral' => 'Jangan pernah melupakan jasa orang tua, terutama ibu yang telah membesarkan kita.',
                'views' => '3.1K',
                'reading_time' => '6 min'
            ],
            [
                'id' => 4,
                'title' => 'Timun Mas dan Buto Ijo',
                'slug' => 'timun-mas',
                'category' => 'Fabel',
                'author' => 'Dongeng Jawa',
                'date' => '21 November 2025',
                'image' => 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800',
                'excerpt' => 'Gadis cilik pemberani yang mengalahkan raksasa jahat dengan kecerdikan dan bantuan benda-benda ajaib.',
                'content' => [
                    'Hiduplah sepasang suami istri petani yang sangat ingin memiliki anak. Mereka berdoa kepada Tuhan agar dikabulkan keinginannya.',
                    'Suatu malam, datanglah Buto Ijo, raksasa hijau yang menawarkan bantuan. Ia memberikan biji mentimun ajaib dengan syarat anak yang lahir harus diserahkan pada usia 17 tahun.',
                    'Dari biji itu tumbuh buah mentimun emas. Ketika dibelah, di dalamnya ada bayi perempuan cantik yang diberi nama Timun Mas.',
                    'Timun Mas tumbuh menjadi gadis cantik dan cerdas. Ketika usianya menginjak 17 tahun, Buto Ijo datang menagih janji. Sang ibu tidak rela dan meminta bantuan pertapa.',
                    'Pertapa memberikan empat bungkusan: biji mentimun, jarum, garam, dan terasi. "Lemparkan ini saat dikejar Buto Ijo," kata pertapa.',
                    'Saat Buto Ijo mengejar, Timun Mas melempar biji mentimun yang berubah jadi hutan lebat. Lalu jarum jadi pohon bambu tajam, garam jadi lautan, dan terasi jadi lautan lumpur mendidih.',
                    'Buto Ijo terjebak dalam lumpur mendidih dan tenggelam. Timun Mas selamat dan hidup bahagia bersama orang tuanya.'
                ],
                'moral' => 'Keberanian dan kecerdikan dapat mengalahkan kekuatan yang jauh lebih besar.',
                'views' => '1.8K',
                'reading_time' => '6 min'
            ],
            [
                'id' => 5,
                'title' => 'Bawang Merah dan Bawang Putih',
                'slug' => 'bawang-merah-bawang-putih',
                'category' => 'Dongeng',
                'author' => 'Cerita Klasik',
                'date' => '20 November 2025',
                'image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800',
                'excerpt' => 'Kisah dua saudara tiri dengan sifat yang bertolak belakang, mengajarkan tentang kebaikan dan kejahatan.',
                'content' => [
                    'Dahulu kala, hiduplah seorang pedagang kaya yang memiliki seorang putri cantik bernama Bawang Putih. Setelah istrinya meninggal, ia menikah lagi dengan seorang janda yang memiliki anak bernama Bawang Merah.',
                    'Tidak lama kemudian, ayah Bawang Putih meninggal dunia. Sejak itu, Bawang Putih diperlakukan seperti pembantu oleh ibu dan kakak tirinya.',
                    'Suatu hari, saat mencuci pakaian di sungai, pakaian Bawang Putih hanyut terbawa arus. Ia mencari ke hilir dan bertemu dengan seorang nenek penyihir baik hati.',
                    'Nenek itu meminta Bawang Putih membantunya. Sebagai terima kasih, nenek memberikan labu sebagai hadiah. Bawang Putih memilih labu kecil agar tidak merepotkan.',
                    'Sesampainya di rumah, labu itu pecah dan berisi emas permata. Bawang Merah dan ibunya iri. Mereka memaksa Bawang Merah pergi ke nenek yang sama.',
                    'Bawang Merah dengan sombong memilih labu terbesar. Namun saat dibuka, keluar ular berbisa dan binatang buas yang mengejarnya.',
                    'Bawang Merah dan ibunya akhirnya menyesali perbuatannya. Sementara Bawang Putih hidup bahagia dan selalu berbagi dengan orang-orang di sekitarnya.'
                ],
                'moral' => 'Kebaikan hati akan selalu mendapat balasan yang baik, sementara kejahatan akan mendapat balasannya.',
                'views' => '2.3K',
                'reading_time' => '6 min'
            ],
            [
                'id' => 6,
                'title' => 'Roro Jonggrang dan Candi Prambanan',
                'slug' => 'roro-jonggrang',
                'category' => 'Legenda',
                'author' => 'Legenda Jawa',
                'date' => '19 November 2025',
                'image' => 'https://images.unsplash.com/photo-1548013146-72479768bada?w=800',
                'excerpt' => 'Asal usul Candi Prambanan dari kisah cinta Bandung Bondowoso yang ditolak Roro Jonggrang.',
                'content' => [
                    'Di Kerajaan Prambanan, hiduplah seorang putri cantik jelita bernama Roro Jonggrang. Kecantikannya terkenal hingga ke seluruh penjuru negeri.',
                    'Bandung Bondowoso, raja dari kerajaan tetangga, jatuh cinta dan ingin menikahi Roro Jonggrang. Namun Roro Jonggrang tidak menyukainya karena Bandung telah membunuh ayahnya dalam peperangan.',
                    'Untuk menolak lamaran tersebut, Roro Jonggrang memberikan syarat yang mustahil: membangun seribu candi dalam satu malam sebelum fajar.',
                    'Bandung Bondowoso yang memiliki kekuatan gaib memanggil jin dan setan untuk membantunya. Mereka bekerja dengan sangat cepat.',
                    'Menjelang subuh, candi hampir selesai. Tinggal satu candi lagi. Roro Jonggrang panik dan meminta para wanita menumbuk lesung dan membakar jerami di timur.',
                    'Ayam-ayam pun berkokok mengira telah pagi. Para jin dan setan ketakutan dan menghentikan pekerjaan mereka. Candi yang ke-1000 tidak selesai.',
                    'Bandung Bondowoso murka mengetahui tipu daya Roro Jonggrang. Ia mengutuk sang putri menjadi arca untuk melengkapi candi yang ke-1000. Arca itu kini berada di Candi Prambanan sebagai arca Durga.'
                ],
                'moral' => 'Tipu daya mungkin berhasil sementara, tetapi dapat membawa akibat yang buruk di kemudian hari.',
                'views' => '2.7K',
                'reading_time' => '7 min'
            ]
        ];
    }

    public function index()
    {
        $stories = $this->getAllStories();
        $categories = array_unique(array_column($stories, 'category'));

        // Featured story (story pertama)
        $featured = $stories[0];

        // Latest stories (sisanya)
        $latest = array_slice($stories, 1);

        return view('story', compact('stories', 'categories', 'featured', 'latest'));
    }

    public function show($slug)
    {
        $stories = $this->getAllStories();
        $story = collect($stories)->firstWhere('slug', $slug);

        if (!$story) {
            abort(404);
        }

        // Related stories (same category, exclude current)
        $related = collect($stories)
            ->where('category', $story['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->toArray();

        return view('story-detail', compact('story', 'related'));
    }

    public function category($category)
    {
        $stories = $this->getAllStories();
        $filtered = collect($stories)->where('category', $category)->toArray();

        return view('category', compact('filtered', 'category'));
    }
}
