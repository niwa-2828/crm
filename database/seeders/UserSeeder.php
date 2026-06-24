<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    User::create([
      'name' => 'Y_Wata（管理）',
      'email' => 'admin@admin.com',
      'password' => Hash::make('N700Supreme'),
      'role' => 'admin',
    ]);

    User::create([
      'name' => 'Y_Hoshi（一般）',
      'email' => 'user@general.com',
      'password' => Hash::make('jre225'),
      'role' => 'user',
    ]);
  }
}
