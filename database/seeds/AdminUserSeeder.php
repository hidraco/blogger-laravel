<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{

    protected $admins = [
        [
            'first_name' => 'jone',
            'last_name' => 'doe',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->admins as $admin)
        {
            $user = \App\Models\User::query()->create( array_only($admin, (new \App\Models\User())->getFillable()) );

            $user->password = bcrypt($admin['password']);
            $user->user_type = \App\Models\User::USER_ADMIN_TYPE;

            $user->save();
        }
    }
}
