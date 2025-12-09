<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comic;
use App\Models\Rental;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@rental-komik.test'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1, Jakarta',
            ],
        );

        $staff = User::updateOrCreate(
            ['email' => 'staff@rental-komik.test'],
            [
                'name' => 'Petugas Rental',
                'username' => 'staff',
                'password' => Hash::make('password123'),
                'role' => 'staff',
                'phone' => '081298765432',
                'address' => 'Jl. Staff No. 2, Bandung',
            ],
        );

        $member = User::updateOrCreate(
            ['email' => 'member@rental-komik.test'],
            [
                'name' => 'Komikus Lovers',
                'username' => 'member',
                'password' => Hash::make('password123'),
                'role' => 'member',
                'phone' => '081223344556',
                'address' => 'Jl. Member No. 3, Surabaya',
            ],
        );

        $categories = collect([
            ['name' => 'Petualangan', 'icon' => 'ph-compass-duotone', 'description' => 'Komik penuh aksi dan perjalanan epik.'],
            ['name' => 'Komedi', 'icon' => 'ph-smiley-duotone', 'description' => 'Bacaan ringan yang bikin tertawa.'],
            ['name' => 'Fantasi', 'icon' => 'ph-planet-duotone', 'description' => 'Dunia penuh sihir dan makhluk unik.'],
            ['name' => 'Slice of Life', 'icon' => 'ph-coffee-duotone', 'description' => 'Cerita hangat keseharian.'],
        ])->map(function (array $category) {
            return Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'icon' => $category['icon'],
                    'description' => $category['description'],
                ],
            );
        });

        $comicsData = [
            [
                'title' => 'One Piece Vol. 1',
                'category' => 'Petualangan',
                'author' => 'Eiichiro Oda',
                'publisher' => 'Elex Media',
                'release_year' => 1997,
                'daily_price' => 8000,
                'stock' => 10,
                'synopsis' => 'Awal petualangan Luffy mencari One Piece.',
            ],
            [
                'title' => 'Spy x Family Vol. 1',
                'category' => 'Komedi',
                'author' => 'Tatsuya Endo',
                'publisher' => 'Shueisha',
                'release_year' => 2019,
                'daily_price' => 9000,
                'stock' => 7,
                'synopsis' => 'Kisah keluarga palsu yang penuh kehebohan.',
            ],
            [
                'title' => 'Frieren: Beyond Journey\'s End',
                'category' => 'Fantasi',
                'author' => 'Kanehito Yamada',
                'publisher' => 'Shogakukan',
                'release_year' => 2020,
                'daily_price' => 8500,
                'stock' => 5,
                'synopsis' => 'Petualangan penyihir abadi setelah dunia diselamatkan.',
            ],
            [
                'title' => 'Blue Period',
                'category' => 'Slice of Life',
                'author' => 'Tsubasa Yamaguchi',
                'publisher' => 'Kodansha',
                'release_year' => 2017,
                'daily_price' => 7000,
                'stock' => 4,
                'synopsis' => 'Perjalanan seni Yatora dalam mengejar mimpinya.',
            ],
        ];

        $comics = collect($comicsData)->map(function (array $comic) use ($categories) {
            $category = $categories->firstWhere('name', $comic['category']);

            return Comic::updateOrCreate(
                ['slug' => Str::slug($comic['title'])],
                [
                    'category_id' => $category->id,
                    'title' => $comic['title'],
                    'author' => $comic['author'],
                    'publisher' => $comic['publisher'],
                    'release_year' => $comic['release_year'],
                    'daily_price' => $comic['daily_price'],
                    'stock' => $comic['stock'],
                    'synopsis' => $comic['synopsis'],
                    'status' => 'available',
                ],
            );
        });

        $sampleRental = Rental::updateOrCreate(
            ['rental_code' => 'RENT-0001'],
            [
                'user_id' => $member->id,
                'staff_id' => $staff->id,
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(5),
                'rental_days' => 7,
                'total_price' => 0,
                'status' => 'ongoing',
                'notes' => 'Contoh pesanan untuk demo dashboard.',
            ],
        );

        $total = 0;
        foreach ($comics->take(2) as $comic) {
            $subtotal = $comic->daily_price * 7;
            RentalItem::updateOrCreate(
                [
                    'rental_id' => $sampleRental->id,
                    'comic_id' => $comic->id,
                ],
                [
                    'quantity' => 1,
                    'price_per_day' => $comic->daily_price,
                    'duration_days' => 7,
                    'subtotal' => $subtotal,
                ],
            );
            $total += $subtotal;
        }

        $sampleRental->update(['total_price' => $total]);

        $this->command?->info('Seeder selesai. Gunakan akun:');
        $this->command?->info('Admin  : admin@rental-komik.test / password123');
        $this->command?->info('Staff  : staff@rental-komik.test / password123');
        $this->command?->info('Member : member@rental-komik.test / password123');
    }
}
