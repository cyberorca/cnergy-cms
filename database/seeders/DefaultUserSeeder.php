<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user = collect();
        $roleAdmin = Role::where('role', 'Admin')->first();

        if($roleAdmin) {
            $default_user->merge(config('admin.defaultAdmin'))
                         ->merge(config('admin.userAdmin'))
            ->map(function ($email) use ($roleAdmin) {
                $user = User::updateOrCreate([
                    'email' => $email
                ], [
                    'name' => 'Admin',
                    'role_id' => $roleAdmin->id,
                    'is_active' => '1',
                ]);

                $this->command->info(sprintf('%s delegated as Admin', $email));
            });
        } else {
            $this->command->info('There is no role named Admin');
        }
    }
}
