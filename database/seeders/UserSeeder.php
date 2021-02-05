<?php
namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->password = Hash::make('beispielpasswort');
        $user->email = 'info@lieferservice.de';
        $user->role = User::ADMIN_ROLE;
        $user->save();
    }
}
