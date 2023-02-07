<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{GuestbookEntry, User};
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'        => 'user-a@example.com',
            'password'     => Hash::make('user-a'),
        ]);

        User::create([
            'email'        => 'user-b@example.com',
            'password'     => Hash::make('user-b'),
        ]);

        GuestbookEntry::create([
            'title'                  => 'This is really amazing',
            'content'                => 'Much better than Amazon',
            'submitter_email'        => 'the-bez@amazon.com',
            'submitter_display_name' => 'TheBez',
            'submitter_real_name'    => 'Beff Jezos',
        ]);

        GuestbookEntry::create([
            'title'                  => 'Wow.',
            'content'                => 'This is so great that it sends me to space',
            'submitter_email'        => 'egomaniac@tesla.com',
            'submitter_display_name' => 'RocketMan',
            'submitter_real_name'    => 'Melon Dusk',
        ]);
    }
}
