<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class CreateSampleUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create-sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create sample admin and student users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create Admin Account
        User::create([
            "username" => "admin_user",  
            "lrn" => null,
            "password" => Hash::make('adminpassword'), 
            "userType" => "administrator" 
        ]);

        // Create Student Account
        User::create([
            "username" => "student_user",  
            "lrn" => 7161,
            "password" => Hash::make('studentpassword'), 
            "userType" => "student"
        ]);

        $this->info('Admin and Student accounts created!');
    }
}
