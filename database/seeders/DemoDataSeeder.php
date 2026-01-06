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
                'description' => '- Free custom audio greetings
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
                'description' => '- Free custom audio greetings
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
                'description' => '- Free custom video greetings
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
                'description' => '- Free custom video greetings
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
            ['name' => 'General Information', 'description' => 'Basic questions about our audio guest book service', 'position' => 1, 'is_active' => true],
            ['name' => 'Booking & Pricing', 'description' => 'Questions about packages, pricing, and reservations', 'position' => 2, 'is_active' => true],
            ['name' => 'Technical & Setup', 'description' => 'Technical questions about equipment and setup', 'position' => 3, 'is_active' => true],
            ['name' => 'Event Day', 'description' => 'What to expect on your event day', 'position' => 4, 'is_active' => true],
            ['name' => 'Post-Event', 'description' => 'Questions about recordings and delivery after your event', 'position' => 5, 'is_active' => true],
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
            echo "  ⚠️  No FAQ categories found. Skipping FAQs.\n";
            return;
        }

        // Distribute 31 FAQs across 5 categories (roughly 6-7 per category)
        $faqs = [
            // General Information (6 FAQs)
            ['category_id' => 1, 'position' => 1, 'question' => 'What is an audio guest book?', 'answer' => 'An audio guest book is a modern alternative to traditional guest books where your guests leave voice messages instead of written notes. These heartfelt recordings capture the emotion, laughter, and genuine wishes from your loved ones.'],
            ['category_id' => 1, 'position' => 2, 'question' => 'How does it work?', 'answer' => 'Guests simply pick up the vintage-style phone at your event, listen to a custom greeting, and record their message. Our team handles all setup and technical support to ensure everything runs smoothly.'],
            ['category_id' => 1, 'position' => 3, 'question' => 'What types of events do you serve?', 'answer' => 'We cater to weddings, birthdays, corporate events, anniversaries, baby showers, and any special celebration where you want to preserve memories.'],
            ['category_id' => 1, 'position' => 4, 'question' => 'Do you provide the equipment?', 'answer' => 'Yes! We provide the complete audio guest book setup including the vintage phone, signage, and all necessary technical equipment.'],
            ['category_id' => 1, 'position' => 5, 'question' => 'How long have you been in business?', 'answer' => 'La Moment has been creating memorable experiences since 2020, serving hundreds of happy clients across Indonesia.'],
            ['category_id' => 1, 'position' => 6, 'question' => 'Where are you located?', 'answer' => 'We are based in Jakarta but serve events throughout Indonesia. Contact us for availability in your area.'],

            // Booking & Pricing (7 FAQs)
            ['category_id' => 2, 'position' => 1, 'question' => 'How much does it cost?', 'answer' => 'Our packages start from Rp 1,500,000. The final price depends on your chosen package, event duration, and customization needs. View our Packages page for detailed pricing.'],
            ['category_id' => 2, 'position' => 2, 'question' => 'What is included in the price?', 'answer' => 'All packages include equipment rental, setup & breakdown, on-site technical support, custom greeting recording, and digital delivery of all recordings after your event.'],
            ['category_id' => 2, 'position' => 3, 'question' => 'How far in advance should I book?', 'answer' => 'We recommend booking at least 2-3 months in advance, especially for weekend events during peak wedding season. However, we can accommodate last-minute bookings subject to availability.'],
            ['category_id' => 2, 'position' => 4, 'question' => 'What is your cancellation policy?', 'answer' => 'Cancellations made 60+ days before event: full refund minus 10% admin fee. 30-59 days: 50% refund. Less than 30 days: no refund. Rescheduling is free if done 30+ days in advance.'],
            ['category_id' => 2, 'position' => 5, 'question' => 'Do you require a deposit?', 'answer' => 'Yes, we require a 30% deposit to secure your booking date. The remaining balance is due 7 days before your event.'],
            ['category_id' => 2, 'position' => 6, 'question' => 'Can I customize my package?', 'answer' => 'Absolutely! We offer various customization options including phone color, signage design, greeting script, and additional services. Contact us to discuss your vision.'],
            ['category_id' => 2, 'position' => 7, 'question' => 'Do you offer discounts?', 'answer' => 'We offer special rates for weekday events, multiple package bookings, and returning clients. Contact us for current promotions.'],

            // Technical & Setup (6 FAQs)
            ['category_id' => 3, 'position' => 1, 'question' => 'How long does setup take?', 'answer' => 'Setup typically takes 30-45 minutes. Our team arrives 1-2 hours before your event to ensure everything is perfect.'],
            ['category_id' => 3, 'position' => 2, 'question' => 'Do you need electricity?', 'answer' => 'Our audio guest books have internal batteries and can run for 8-12 hours without power. However, we recommend having a power outlet nearby as backup for longer events.'],
            ['category_id' => 3, 'position' => 3, 'question' => 'What if the equipment malfunctions?', 'answer' => 'Our team is on-site throughout your event to handle any technical issues immediately. We also bring backup equipment to every event.'],
            ['category_id' => 3, 'position' => 4, 'question' => 'Can guests re-record their message?', 'answer' => 'Yes! Guests can re-record their message as many times as they want before finalizing. Only the final version is saved.'],
            ['category_id' => 3, 'position' => 5, 'question' => 'Is there a recording time limit?', 'answer' => 'Each message can be up to 3 minutes long, which is plenty of time for heartfelt wishes. There is no limit to the total number of recordings.'],
            ['category_id' => 3, 'position' => 6, 'question' => 'What happens to the recordings?', 'answer' => 'All recordings are automatically saved to secure cloud storage in real-time. You will never lose a single message, even if there is a power outage.'],

            // Event Day (6 FAQs)
            ['category_id' => 4, 'position' => 1, 'question' => 'Will someone be there to help guests?', 'answer' => 'Yes! Our professional attendant will be present throughout your event to guide guests, troubleshoot any issues, and ensure smooth operation.'],
            ['category_id' => 4, 'position' => 2, 'question' => 'Where should the audio guest book be placed?', 'answer' => 'We recommend placing it in a high-traffic area near the entrance, photo booth, or cocktail area. Our team will advise the best location based on your venue layout.'],
            ['category_id' => 4, 'position' => 3, 'question' => 'What if my venue has poor lighting?', 'answer' => 'We bring portable lighting equipment to ensure the guest book area is well-lit and visually appealing in photos.'],
            ['category_id' => 4, 'position' => 4, 'question' => 'Can I customize the greeting message?', 'answer' => 'Absolutely! We will work with you to create a personalized greeting that reflects your event theme and personality. You can record it yourself or we can use a professional voice-over.'],
            ['category_id' => 4, 'position' => 5, 'question' => 'How many guests can use it per hour?', 'answer' => 'On average, 15-20 guests can comfortably record messages per hour. For larger events, we recommend adding a second phone station.'],
            ['category_id' => 4, 'position' => 6, 'question' => 'What if guests are shy or unsure what to say?', 'answer' => 'Our attendant provides gentle prompts and example questions displayed on signage. Most guests warm up quickly once they start!'],

            // Post-Event (6 FAQs)
            ['category_id' => 5, 'position' => 1, 'question' => 'How do I receive the recordings?', 'answer' => 'All recordings are delivered via secure download link within 3-5 business days after your event. You will receive individual audio files plus a compiled version with soft background music.'],
            ['category_id' => 5, 'position' => 2, 'question' => 'What format are the recordings in?', 'answer' => 'Recordings are delivered in high-quality MP3 format, compatible with all devices and easy to share with family and friends.'],
            ['category_id' => 5, 'position' => 3, 'question' => 'Can I get the recordings on USB?', 'answer' => 'Yes! We offer optional USB delivery in a beautiful presentation box for an additional fee. Perfect as a keepsake or gift.'],
            ['category_id' => 5, 'position' => 4, 'question' => 'How long do you keep the recordings?', 'answer' => 'Your recordings are backed up securely for 1 year after your event. After that, we recommend downloading and saving your own copies.'],
            ['category_id' => 5, 'position' => 5, 'question' => 'Can you edit the recordings?', 'answer' => 'Yes! We offer optional editing services including removing background noise, awkward pauses, or combining multiple messages. Contact us for pricing.'],
            ['category_id' => 5, 'position' => 6, 'question' => 'Can I share the recordings on social media?', 'answer' => 'Absolutely! The recordings are yours to keep, share, and treasure forever. Many couples love sharing snippets on their wedding anniversary.'],
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
            ['name' => 'Rizky Pratama', 'rating' => 5, 'content' => 'Ide ini benar-benar unik dan menjadi salah satu highlight di acara kami. Sejak awal proses, semuanya terasa profesional dan terorganisir dengan sangat baik. Timnya komunikatif, jelas, dan membantu di setiap tahap, sehingga kami tidak perlu khawatir sama sekali.
                Saat hari acara, tamu-tamu kami langsung tertarik dan penasaran untuk mencoba. Banyak yang awalnya hanya ingin iseng, tapi akhirnya malah menikmati dan meninggalkan pesan yang panjang. Yang paling kami kagumi adalah kualitas audionya—meskipun suasana acara cukup ramai, suara tetap terdengar jelas dan nyaman saat didengarkan kembali.
                Setelah acara selesai, kami menerima kumpulan pesan suara yang luar biasa: ada yang lucu, ada yang spontan, ada yang penuh emosi, dan semuanya terasa sangat tulus.
                Mendengarkan ulang pesan-pesan ini benar-benar membawa kami kembali ke suasana hari itu. Ini bukan hanya sekadar pengganti buku tamu, tapi sebuah kenangan hidup yang bisa kami simpan dan dengarkan kapan pun kami mau. Kami sangat bersyukur memilih layanan ini dan tanpa ragu akan merekomendasikannya ke siapa pun yang ingin membuat acaranya lebih bermakna dan tak terlupakan.'],
            ['name' => 'Nadya Salsabila', 'rating' => 5, 'content' => 'Best decision we made for our wedding! Guests loved leaving voice messages. The attendant was friendly and helped shy guests feel comfortable. We listen to the recordings every anniversary.'],
            ['name' => 'Amanda Lee', 'rating' => 5, 'content' => 'Great service overall! The audio quality was excellent and delivery was prompt. Only minor issue was setup took slightly longer than expected, but everything worked perfectly during the event.'],
            ['name' => 'Kevin & Rachel', 'rating' => 5, 'content' => 'We cannot stop listening to our wedding messages! La Moment captured laughter, tears, and everything in between. The vintage phone was a beautiful aesthetic addition to our venue too.'],
            ['name' => 'Michelle Kosasih', 'rating' => 5, 'content' => 'Used this for my 30th birthday party and it was a hit! Friends left hilarious and touching messages. Much better than a traditional guest book that nobody reads.'],
            ['name' => 'Daniel & Christine', 'rating' => 5, 'content' => 'Absolutely worth every penny! The team was punctual, professional, and made sure everything ran smoothly. Our guests loved the concept and we have 3 hours of beautiful memories.'],
            ['name' => 'Lisa Gunawan', 'rating' => 5, 'content' => 'La Moment exceeded our expectations! The custom greeting was perfect, and the edited compilation they provided was beautifully done. This is a must-have for any special event!'],
            ['name' => 'Ryan Hartono', 'rating' => 5, 'content' => 'Really good service! The audio guest book was a unique touch to our corporate event. Employees loved it. Would have given 5 stars if the USB option was included in the basic package.'],
            ['name' => 'Stephanie Chen', 'rating' => 5, 'content' => 'Best vendor we hired for our wedding! The attendant was amazing with guests, the equipment looked elegant, and we now have 2+ hours of precious memories. Thank you La Moment!'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
            ['name' => 'Name X', 'rating' => 5, 'content' => 'Review content X'],
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