<?php
// filepath: database/seeders/DemoDataSeeder.php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\FaqCategory;
use App\Models\Faq;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        echo "Seeding demo data...\n";

        $this->seedPackages();
        $this->seedFaqCategories();
        $this->seedFaqs();
        $this->seedReviews();

        echo "Demo data seeding completed!\n";
    }

    // ========== PACKAGES ==========
    private function seedPackages(): void
    {
        echo "Seeding Packages...\n";

        $packages = [
            [
                'name' => 'Basic Vintage Video Guestbook',
                'description' =>
'- Free custom audio greetings
- Stand by 3 jam acara (termasuk kru)
- Set up decor (Neon sign, photo frame, how to use, vas bunga, lilin)
- File MP3 by Google Drive
- Video edit MP4 by Google Drive
- Hasil akan dikirimkan H+7',
                'base_price' => 1750000,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Vintage Video Guestbook',
                'description' =>
'- Free custom audio greetings
- Stand by 3 jam acara (termasuk kru)
- Set up decor (Neon sign, photo frame, how to use, vas bunga, lilin)
- File MP3 by Google Drive
- Video edit MP4 by Google Drive
- Hasil akan dikirimkan H+5
- Retro Custom Package yang dapat dipersonalisasi',
                'base_price' => 2450000,
                'is_active' => true,
            ],
            [
                'name' => 'Basic Heritage Video Guestbook',
                'description' =>
'- Free custom video greetings
- Stand by 3 jam acara (termasuk kru)
- Set up decor (Neon sign, photo frame, how to use, vas bunga, lilin)
- File MP3 by Google Drive
- Video edit MP4 by Google Drive
- Hasil akan dikirimkan H+7',
                'base_price' => 1900000,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Heritage Video Guestbook',
                'description' =>
'- Free custom video greetings
- Stand by 3 jam acara (termasuk kru)
- Set up decor (Neon sign, photo frame, how to use, vas bunga, lilin)
- File MP3 by Google Drive
- Video edit MP4 by Google Drive
- Hasil akan dikirimkan H+5
- Retro Custom Package yang dapat dipersonalisasi',
                'base_price' => 2600000,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            if (!Package::where('name', $pkg['name'])->exists()) {
                Package::create($pkg);
                echo "  ✓ Created: {$pkg['name']}\n";
            }
        }
    }

    // ========== FAQ CATEGORIES ==========
    private function seedFaqCategories(): void
    {
        echo "Seeding FAQ Categories...\n";

        $categories = [
            ['name' => 'Tentang Audio Guestbook La Moment', 'description' => '...', 'position' => 1, 'is_active' => true],
            ['name' => 'Pesan, Kapasitas & Hasil Rekaman', 'description' => '...', 'position' => 2, 'is_active' => true],
            ['name' => 'Cara Kerja & Penggunaan di Acara', 'description' => '...', 'position' => 3, 'is_active' => true],
            ['name' => 'Paket, Pemesanan & Pembayaran', 'description' => '...', 'position' => 4, 'is_active' => true],
            ['name' => 'Perubahan, Lokasi & Bantuan', 'description' => '...', 'position' => 5, 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            if (!FaqCategory::where('name', $cat['name'])->exists()) {
                FaqCategory::create($cat);
                echo "  ✓ Created: {$cat['name']}\n";
            }
        }
    }

    // ========== FAQS ==========
    private function seedFaqs(): void
    {
        echo "Seeding FAQs...\n";

        $categories = FaqCategory::all();
        if ($categories->isEmpty()) {
            echo "No FAQ categories found. Skipping FAQs.\n";
            return;
        }

        // Distribute 31 FAQs across 5 categories (roughly 6-7 per category)
        $faqs = [
            // General Information (3 FAQs)
            ['category_id' => 1, 'position' => 1, 'question' => 'Apa itu Audio Guestbook?', 'answer' => 'Audio Guestbook adalah buku tamu modern berbasis audio dan visual. Alih-alih pesan tertulis, para tamu dapat meninggalkan rekaman audio berupa harapan baik, cerita indah kenangan masa lalu, atau ucapan selamat.'],
            ['category_id' => 1, 'position' => 2, 'question' => 'Untuk acara apa Audio Guestbook La Moment dapat digunakan?', 'answer' => 'Audio Guestbook La Moment tidak hanya untuk acara pernikahan. Anda dapat menerima pesan istimewa dari tamu Anda pada acara ulang tahun, tunangan, acara perusahaan, acara sosial, pesta perpisahan di sekolah, acara keluarga besar, atau acara lain yang ingin Anda jadikan sebagai kegiatan yang tak terlupakan.'],
            ['category_id' => 1, 'position' => 3, 'question' => 'Apakah Audio Guestbook La Moment hanya merekam suara?', 'answer' => 'Tidak, kami akan merekam suara, wajah, dan bahkan reaksi, sehingga anda dapat mengetahui siapa yang meninggalkan pesan spesial itu. Ini bukan sekedar pesan, ini adalah momen penting yang hanya terjadi sekali dalam hidup dan layak diabadikan.'],

            // Booking & Pricing (7 FAQs)
            ['category_id' => 2, 'position' => 1, 'question' => 'Bagaimana cara kerja telepon ini?', 'answer' => 'Sangat mudah! Di acara spesial Anda, para tamu mengangkat telepon, ucapan salam pembuka dari Anda akan diputar secara otomatis, setelah bunyi bip tamu akan meninggalkan pesan lalu menutup telepon. Setelah telepon ditutup, pesan spesial akan tersimpan untuk Anda.'],
            ['category_id' => 2, 'position' => 2, 'question' => 'Kapan telepon siap digunakan?', 'answer' => 'Telepon akan siap digunakan sesuai permintaan Anda. Akan ada kru kami yang akan membantu tamu-tamu Anda.'],
            ['category_id' => 2, 'position' => 3, 'question' => 'Apakah memerlukan kabel telepon rumah atau koneksi WiFi?', 'answer' => 'Tidak, kami tidak membutuhkan kabel telepon rumah dan WiFi. Telepon kami memiliki baterai yang sudah ditanam sehingga akan rapi saat digunakan.'],
            ['category_id' => 2, 'position' => 4, 'question' => 'Bagaimana tamu saya akan tahu cara meninggalkan pesan?', 'answer' => 'Tamu Anda dapat membaca petunjuk meninggalkan pesan pada standing paper yang sudah kami sediakan. Selain itu, akan ada kru La Moment yang selalu siap membantu tamu Anda.'],
            ['category_id' => 2, 'position' => 5, 'question' => 'Apakah tersedia petunjuk atau panduan untuk para tamu?', 'answer' => 'Akan ada petunjuk yang kami sediakan, selain itu akan ada Kru kami yang siap melayani dan membantu tamu undangan kalian. Kalian hanya perlu membiarkan Kru kami bekerja dan mendapatkan pesan-pesan istimewa dari tamu Anda.'],
            ['category_id' => 2, 'position' => 6, 'question' => 'Apa yang sebaiknya kami katakan sebagai salam pembuka untuk menyambut tamu?', 'answer' => 'Ucapkan selamat datang dan berterima kasih kepada para tamu undangan yang sudah menyempatkan diri untuk berbahagia di hari spesial Anda, mereka akan sangat gembira mendengar suara kalian. Jika Anda membutuhkan inspirasi, kami juga akan menyiapkan sejumlah referensi salam pembuka yang dapat anda berikan.'],
            ['category_id' => 2, 'position' => 7, 'question' => 'Berapa lama durasi rekaman setiap tamu?', 'answer' => 'Selama tamu tersebut ingin berbicara.'],
            ['category_id' => 2, 'position' => 8, 'question' => 'Di mana sebaiknya saya meletakkan telepon Audio Guestbook?', 'answer' => 'Sejujurnya, di mana saja Anda inginkan. Berdasarkan pengalaman, kami merekomendasikan pada area yang sering dilalui tamu tetapi tidak terpapar speaker ruang acara secara langsung. Pada area yang sering dilalui tamu akan menjadi lokasi yang baik karena tamu dapat mengakses Audio Guestbook dengan mudah. Pada area terpapar speaker ruang acara secara langsung akan kurang baik karena kami khawatir tamu Anda sulit untuk berbicara saat volume speaker ruang acara terlalu besar.'],
            ['category_id' => 2, 'position' => 9, 'question' => 'Apakah Audio Guestbook La Moment bisa digunakan untuk acara outdoor?', 'answer' => 'Bisa, kami melayani kegiatan di luar ruangan (acara outdoor). Meski begitu, unit kami belum mampu mengatasi terjangan air hujan dan panas matahari langsung. Saat kondisi hujan terjadi secara mendadak, kami tetap akan beroperasi sesuai jam yang telah ditentukan asalkan kami diberikan area yang tidak terdampak hujan.'],

            // Technical & Setup (7 FAQs)
            ['category_id' => 3, 'position' => 1, 'question' => 'Apakah ada batasan jumlah pesan suara?', 'answer' => 'Tidak ada batasan jumlah pesan yang dapat diberikan selama durasi paket yang anda pilih. Audio Guestbook La Moment menawarkan kapasitas memori yang mampu merekam selama 12 jam dan memungkinkan untuk menyimpan 2.000 pesan.'],
            ['category_id' => 3, 'position' => 2, 'question' => 'Berapa banyak pesan yang dapat ditampung oleh Audio Guestbook La Moment?', 'answer' => 'Kami memiliki waktu perekaman lebih dari 12 jam. Ini lebih lama dari acara Anda! Setiap orang akan mendapat kesempatan untuk meninggalkan 1, 2, atau bahkan 3 pesan. Kru kami akan selalu membantu tamu Anda.'],
            ['category_id' => 3, 'position' => 3, 'question' => 'Apakah ada pesan suara yang dihapus atau tidak disertakan?', 'answer' => 'Kami berupaya agar semua pesan suara dapat Anda dengar! Namun, kami akan menghapus bagian-bagian tertentu dari pesan suara yang tidak bersuara.'],
            ['category_id' => 3, 'position' => 4, 'question' => 'Berapa lama durasi video (MP4) yang akan saya dapatkan?', 'answer' => 'Anda akan mendapatkan dua video. Video pertama selama kurang lebih 60 detik dan sangat sesuai untuk digunakan mengisi Story Instagram Anda. Video kedua merupakan video full version, dimana semua tamu undangan Anda yang berbicara pada Audio Guestbook akan kami tampilkan. Berdasarkan pengalaman kami, setiap tamu umumnya berbicara 10-45 detik.'],
            ['category_id' => 3, 'position' => 5, 'question' => 'Bagaimana cara saya mendapatkan hasil rekaman audio dan video?', 'answer' => 'Kami akan mengirimkan video dan audio yang sudah diedit kepada Anda pada H+5 hingga H+7 acara Anda, sesuai pilihan paket. Video dan audio akan dikirimkan melalui tautan google drive pada nomor WA yang sudah terkonfirmasi. Anda dapat memutar pesan-pesan tulus dari orang-orang terkasih, mengunduhnya, dan berbagi kenangan berharga ini dengan teman dan keluarga hanya dalam beberapa klik! Anda juga akan mendapatkan audio dalam bentuk retro radio pada hampers spesial apabila memilih paket premium.'],
            ['category_id' => 3, 'position' => 6, 'question' => 'Kapan saya akan menerima pesan suara dari acara saya?', 'answer' => 'Hanya 5-7 hari setelah acara Anda selesai sesuai dengan paket yang anda pilih. Kami berjanji akan mengupayakan secepatnya dengan hasil semaksimal mungkin.'],
            ['category_id' => 3, 'position' => 7, 'question' => 'Berapa lama link audio dan video dapat diakses?', 'answer' => 'Link video dan audio dapat anda akses selama 30 hari. Setelah 30 hari, video dan audio dapat terhapus secara otomatis dari link drive tersebut. Tenang saja, Anda dapat menyimpan file tersebut sebelum 30 hari tanpa ada biaya tambahan.'],
            // Event Day (7 FAQs)
            ['category_id' => 4, 'position' => 1, 'question' =>
'Apa saja yang termasuk dalam biaya paket Audio Guestbook La Moment?', 'answer' => '- Audio Guestbook sesuai pilihan Anda
- Custom audio atau video greetings sesuai pilihan paket Anda
- Stand by kru La Moment untuk membantu tamu Anda
- Pigura estetik dengan foto anda bagi paket vintage ataupun display foto anda pada layar unit telepon bagi paket heritage
- Lilin dekorasi, vas bunga sebagai dekorasi pendukung
- Neon sign untuk memastikan wajah tamu dapat terekam oleh kamera dengan jelas sekaligus sebagai hiasan meja yang eye-catching
- Meja untuk Video Guestbook La Moment
- Kain meja sesuai warna acara Anda
- Audio pesan spesial dari setiap tamu
- Video edit berdurasi panjang yang berisi pesan dari semua tamu yang meninggalkan suara
- Video edit 1 menit yang sangat sesuai untuk konten media sosial Anda'],
            ['category_id' => 4, 'position' => 2, 'question' => 'Apakah saya bisa menyewa dengan durasi lebih lama dari yang tertera di paket?', 'answer' => 'Bisa, kami menyediakan tambahan durasi dengan kelipatan 60 menit. Sesuaikan kebutuhan acaramu agar semua kenangan indah dan manis dapat tersimpan dengan baik.'],
            ['category_id' => 4, 'position' => 3, 'question' => 'Bagaimana cara memesan Audio Guestbook La Moment untuk acara saya?', 'answer' => 'Untuk memesan Audio Guestbook La Moment bagi acara Anda, kunjungi halaman Packages atau hubungi nomor WA 0823-1860-6525.'],
            ['category_id' => 4, 'position' => 4, 'question' => 'Kapan waktu terbaik untuk melakukan pemesanan?', 'answer' => 'Semakin cepat Anda memesan, semakin baik untuk mengamankan tanggal Anda. Pada musim ramai seperti Oktober/November/Februari/Maret, Anda perlu memesan lebih awal untuk mendapatkan slot tanggal yang diinginkan.'],
            ['category_id' => 4, 'position' => 5, 'question' => 'Tanggal acara saya sudah dekat, apakah saya masih bisa memesan?', 'answer' => 'La Moment percaya acara Anda merupakan acara penting yang sangat harus diabadikan dalam Audio Guestbook. Hubungi kami dan kami akan mengupayakan agar Audio Guestbook La Moment hadir pada hari spesial Anda.'],
            ['category_id' => 4, 'position' => 6, 'question' => 'Apakah layanan tersedia untuk hari kerja (weekdays)?', 'answer' => 'Kami bekerja selama tujuh hari dalam satu minggu. Kami melayani untuk hari Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, dan Minggu selama slot tanggal masih tersedia.'],
            ['category_id' => 4, 'position' => 7, 'question' => 'Kapan pembayaran harus dilakukan?', 'answer' => 'Pada saat pemilihan dan penguncian tanggal diperlukan pembayaran 50%. Sisa pembayaran harus dilunasi satu bulan sebelum acara tersebut. Kami memahami bahwa anda memiliki banyak aktivitas, sehingga kami akan membantu mengirimkan pengingat melalui WhatsApp.'],

            // Post-Event (5 FAQs)
            ['category_id' => 5, 'position' => 1, 'question' => 'Apakah saya dapat melakukan perubahan tanggal pemakaian layanan?', 'answer' => 'Kami memahami bahwa rencana dapat berubah. Anda dapat melakukan perubahan tanggal acara tanpa tambahan biasa sebanyak satu kali dengan syarat melakukan konfirmasi 30 hari sebelum tanggal acara perencanaan awal. (Selama slot tanggal masih tersedia).'],
            ['category_id' => 5, 'position' => 2, 'question' => 'Bagaimana kebijakan pembatalan dan refund?', 'answer' =>
'Pembatalan pesanan dapat dilakukan dengan cara menghubungi nomor WA berikut -.
Pengembalian dana 25% dapat dilakukan bila:
- Sudah melakukan pembayaran 100%.
- Melakukan konfirmasi tujuh hari sebelum tanggal acara.
*DP Tidak dapat dikembalikan.'],
            ['category_id' => 5, 'position' => 3, 'question' => 'Apakah akan ada biaya transportasi?', 'answer' => 'Untuk area di Surabaya, semuanya GRATIS. Untuk area lainnya, kami akan membutuhkan sedikit biaya akomodasi kru sesuai jarak yang kami tempuh. Hubungi kami untuk mengetahui biaya transportasi menuju kota Anda.'],
            ['category_id' => 5, 'position' => 4, 'question' => 'Saya akan mengadakan pernikahan di luar pulau, bolehkah saya membawa telepon?', 'answer' => 'Kirimkan detailnya kepada kami mulai dari lokasi, waktu, dan berapa lama acara Anda, dan kami akan memperjuangkan untuk dapat hadir pada acara istimewa Anda.'],
            ['category_id' => 5, 'position' => 5, 'question' => 'Bagaimana jika saya memiliki pertanyaan atau saran lain?', 'answer' => 'Jangan ragu untuk menghubungi kami melalui WA 0823-1860-6525. Kami menyambut setiap masukan atau ide untuk meningkatkan layanan kami. Kami terbuka untuk mendiskusikan berbagai kebutuhan Anda demi mewujudkan acara terindah Anda.'],
        ];

        foreach ($faqs as $index => $faqData) {
            $category = $categories->firstWhere('position', $faqData['category_id']);
            if (!$category) continue;

            if (!Faq::where('question', $faqData['question'])->exists()) {
                Faq::create([
                    'faq_category_id' => $category->faq_category_id,
                    'question' => $faqData['question'],
                    'answer' => $faqData['answer'],
                    'position' => $faqData['position'],
                    'is_active' => true,
                ]);
                echo "  ✓ Created FAQ #" . ($index + 1) . ": {$faqData['question']}\n";
            }
        }
    }

    // ========== REVIEWS ==========
    private function seedReviews(): void
    {
        echo "Seeding Reviews...\n";

        $reviewTemplates = [
            ['name' => 'Alya Putri', 'rating' => 5, 'content' => 'Pengalaman yang luar biasa! Prosesnya sangat mudah dan hasilnya benar-benar berkesan. Mendengarkan kembali pesan-pesan suara setelah acara bikin terharu. Sangat direkomendasikan.'],
            ['name' => 'Rizky Pratama', 'rating' => 5, 'content' =>
'Ide ini benar-benar unik dan menjadi salah satu highlight di acara kami. Sejak awal proses, semuanya terasa profesional dan terorganisir dengan sangat baik. Timnya komunikatif, jelas, dan membantu di setiap tahap, sehingga kami tidak perlu khawatir sama sekali.

Saat hari acara, tamu-tamu kami langsung tertarik dan penasaran untuk mencoba. Banyak yang awalnya hanya ingin iseng, tapi akhirnya malah menikmati dan meninggalkan pesan yang panjang. Yang paling kami kagumi adalah kualitas audionya—meskipun suasana acara cukup ramai, suara tetap terdengar jelas dan nyaman saat didengarkan kembali.
Setelah acara selesai, kami menerima kumpulan pesan suara yang luar biasa: ada yang lucu, ada yang spontan, ada yang penuh emosi, dan semuanya terasa sangat tulus.

Mendengarkan ulang pesan-pesan ini benar-benar membawa kami kembali ke suasana hari itu. Ini bukan hanya sekadar pengganti buku tamu, tapi sebuah kenangan hidup yang bisa kami simpan dan dengarkan kapan pun kami mau. Kami sangat bersyukur memilih layanan ini dan tanpa ragu akan merekomendasikannya ke siapa pun yang ingin membuat acaranya lebih bermakna dan tak terlupakan.'],
            ['name' => 'Nadya Salsabila', 'rating' => 5, 'content' => 'Salah satu keputusan terbaik di hari spesial kami. Pesan suara dari keluarga dan teman terasa jauh lebih hidup dibanding guest book biasa.'],
            ['name' => 'Dimas Angkasa', 'rating' => 5, 'content' => 'Dari awal kami memang ingin sesuatu yang berbeda, dan konsep ini benar-benar menjawab itu. Tamu-tamu terlihat antusias saat mencoba meninggalkan pesan suara, bahkan banyak yang kembali lagi untuk mengulang pesan karena merasa seru. Setelah acara selesai, mendengarkan kembali semua pesan suara menjadi momen favorit kami. Ada pesan lucu, ada yang penuh doa, dan ada juga yang bikin kami terharu. Rasanya jauh lebih personal dan hangat dibanding pesan tertulis, dan kami tahu ini akan jadi kenangan yang akan sering kami putar ulang di masa depan.'],
            ['name' => 'Intan Maharani', 'rating' => 5, 'content' => 'Tamu-tamu kami antusias dan ketagihan meninggalkan pesan. Sekarang kami punya kenangan yang bisa diputar kapan saja.'],
            ['name' => 'Fajar Nugraha', 'rating' => 5, 'content' => 'Sangat mudah digunakan dan jadi highlight di acara kami. Banyak pesan lucu dan menyentuh yang kami simpan selamanya.'],
            ['name' => 'Putri Ayuningtyas', 'rating' => 5, 'content' => 'Konsepnya benar-benar berbeda dan memberikan kesan yang mendalam bagi kami dan para tamu. Banyak yang bilang ini ide yang unik dan jarang ditemui. Setelah acara selesai, mendengarkan kembali pesan suara menjadi salah satu momen favorit kami karena terasa hangat dan penuh kenangan. Ada pesan lucu, ada yang menyentuh, dan semuanya terasa sangat personal. Ini jadi kenangan yang akan selalu kami simpan dan putar ulang di kemudian hari.'],
            ['name' => 'Ardi Saputra', 'rating' => 5, 'content' => 'Semua berjalan lancar dan rapi. Kualitas suara bagus meski acaranya ramai. Sangat puas dengan pelayanannya.'],
            ['name' => 'Melisa Kartika', 'rating' => 5, 'content' => 'Layanan ini benar-benar memberikan sentuhan yang berbeda dan sangat berkesan di hari penting kami. Kami merasa tamu-tamu jadi jauh lebih bebas mengekspresikan perasaan mereka lewat suara dibanding harus menulis di buku tamu. Ada yang tertawa, ada yang bercanda, dan ada juga yang menyampaikan pesan yang sangat menyentuh. Mendengarkan kembali pesan-pesan tersebut setelah acara selesai rasanya seperti mengulang momen bahagia itu sekali lagi. Ini bukan sekadar dokumentasi, tapi kenangan yang hidup dan penuh emosi.'],
            ['name' => 'Bagas Wicaksono', 'rating' => 5, 'content' => 'Praktis, seru, dan memorable. Kami tidak menyangka hasilnya akan sebermakna ini.'],
            ['name' => 'Citra Lestari', 'rating' => 5, 'content' => 'Sangat direkomendasikan untuk yang ingin sesuatu yang berbeda. Prosesnya cepat dan tidak ribet sama sekali.'],
            ['name' => 'Yoga Pramudya', 'rating' => 5, 'content' => 'Ide sederhana tapi dampaknya besar. Pesan suara yang kami terima sangat beragam dan penuh emosi.'],
            ['name' => 'Anisa Rahma', 'rating' => 5, 'content' => 'Pelayanan ramah dan profesional. Dari pemesanan sampai pengembalian semuanya mudah.'],
            ['name' => 'Kevin Adrian', 'rating' => 5, 'content' => 'Tamu-tamu kami suka banget dengan konsep ini. Banyak yang bilang ini hal paling seru di acara kami.'],
            ['name' => 'Maya Kurnia', 'rating' => 5, 'content' => 'Kualitas audionya jernih dan hasil akhirnya rapi. Kenangan yang sangat berharga untuk kami.'],
            ['name' => 'Rendi Firmansyah', 'rating' => 5, 'content' => 'Lebih berkesan dibanding buku tamu biasa. Pesan suara terasa lebih personal dan hidup.'],
            ['name' => 'Saskia Amelina', 'rating' => 5, 'content' => 'Kami senang sekali mendengarkan ulang pesan dari orang-orang terdekat. Benar-benar priceless.'],
            ['name' => 'Ilham Maulana', 'rating' => 5, 'content' => 'Sejak awal, semua instruksi yang diberikan sangat jelas dan mudah dipahami. Bahkan tamu-tamu kami yang baru pertama kali mencoba langsung mengerti tanpa perlu banyak penjelasan. Prosesnya simpel dan tidak membuat bingung, jadi alurnya berjalan lancar sepanjang acara. Kami juga senang karena tamu dari berbagai usia bisa ikut berpartisipasi dengan nyaman. Hal ini membuat pengalaman keseluruhan terasa menyenangkan dan bebas ribet.'],
            ['name' => 'Vania Oktaviani', 'rating' => 5, 'content' => 'Konsep kreatif yang bikin acara makin berkesan. Banyak pesan lucu yang bikin kami tertawa saat diputar ulang.'],
            ['name' => 'Bayu Setiawan', 'rating' => 5, 'content' => 'Salah satu elemen favorit di acara kami. Banyak tamu memuji idenya.'],
            ['name' => 'Nabila Khairunnisa', 'rating' => 5, 'content' => 'Prosesnya cepat dan tidak merepotkan. Hasilnya sangat memuaskan dan penuh kenangan manis.'],
            ['name' => 'Andreas Wijaya', 'rating' => 5, 'content' => 'Sangat cocok untuk acara spesial. Pesan suara terasa lebih tulus dibanding tulisan.'],
            ['name' => 'Lia Permatasari', 'rating' => 5, 'content' => 'Tamu-tamu kami benar-benar menikmati pengalaman ini. Kami pun senang mendengarkan kembali semua pesannya.'],
            ['name' => 'Hendra Gunawan', 'rating' => 5, 'content' => 'Ide yang segar dan berbeda. Komunikasi dengan tim juga sangat baik.'],
            ['name' => 'Shinta Aulia', 'rating' => 5, 'content' => 'Kami tidak menyesal memilih ini. Sekarang kami punya arsip suara yang sangat berarti.'],
            ['name' => 'Farhan Alif', 'rating' => 5, 'content' => 'Mudah digunakan dan hasilnya berkualitas. Cocok untuk acara yang ingin meninggalkan kesan mendalam.'],
            ['name' => 'Dewi Laksmi', 'rating' => 5, 'content' => 'Pesan-pesan yang kami terima sangat mengharukan. Ini jadi kenangan seumur hidup.'],
            ['name' => 'Raka Mahendra', 'rating' => 5, 'content' => 'Tamu kami langsung paham cara menggunakannya. Semuanya berjalan lancar tanpa kendala.'],
            ['name' => 'Yuni Safitri', 'rating' => 5, 'content' => 'Sangat menyenangkan dan penuh kejutan saat mendengarkan ulang pesan suara.'],
            ['name' => 'Agung Santoso', 'rating' => 5, 'content' => 'Konsepnya unik dan pelaksanaannya rapi. Kami sangat puas dengan hasilnya.'],
            ['name' => 'Salma Nurfadila', 'rating' => 5, 'content' => 'Salah satu bagian paling berkesan di acara kami. Banyak pesan spontan yang jujur dan lucu.'],
            ['name' => 'Bimo Arya', 'rating' => 5, 'content' => 'Lebih hidup dibanding guest book biasa. Pesan suara benar-benar menyampaikan emosi.'],
            ['name' => 'Karin Widjaja', 'rating' => 5, 'content' => 'Prosesnya tidak ribet dan sangat membantu. Hasil akhirnya luar biasa.'],
            ['name' => 'Reza Kurniawan', 'rating' => 5, 'content' => 'Kami senang bisa mendengarkan suara orang-orang terdekat kapan saja.'],
            ['name' => 'Nina Puspita', 'rating' => 5, 'content' => 'Konsep yang simpel tapi sangat bermakna. Sangat direkomendasikan.'],
        ];

        foreach ($reviewTemplates as $index => $review) {
            if (Review::where('name', $review['name'])->where('content', $review['content'])->exists()) {
                continue;
            }

            Review::create([
                'name' => $review['name'],
                'rating' => $review['rating'],
                'content' => $review['content'],
                'date' => now()->subDays(rand(1, 365)), // Random date within last year
                'is_active' => true,
            ]);
            echo "  ✓ Created Review #" . ($index + 1) . ": {$review['name']}\n";
        }
    }
}