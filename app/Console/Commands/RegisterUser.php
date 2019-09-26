<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Services\ProfileService;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:user'; //Command will be called as php artisan register:user

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user from the command line.';

    /**
     * User model.
     *
     * @var object
     */
    private $user;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProfileService $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = $this->getDetails();
        $admin = $this->user->createUser($details);
        $this->display($admin);
    }

    /**
     * Ask for user details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $details['email'] = $this->ask('Email');
        $details['password'] = $this->secret('Password');
        $details['confirm_password'] = $this->secret('Confirm password');
        while (! $this->isValidPassword($details['email'], $details['password'], $details['confirm_password'])) {
            if (! $this->existEmail($details['email'])) {
                $this->error('The email has already been taken');
            }
            if (! $this->isEmail($details['email'])) {
                $this->error('Invalid email format');
            }
            if (! $this->isRequiredLength($details['password'])) {
                $this->error('The password must be at least 8 characters');
            }
            if (! $this->isMatch($details['password'], $details['confirm_password'])) {
                $this->error('Password and Confirm password do not match');
            }
            $details['email'] = $this->ask('Email');
            $details['password'] = $this->secret('Password');
            $details['confirm_password'] = $this->secret('Confirm password');
        }
        return $details;
    }

    /**
     * Display created user.
     *
     * @param array $user
     * @return void
     */
    private function display(User $user) : void
    {
        $headers = ['Email'];
        $fields = [
            'email' => $user->email,
        ];
        $this->info('User created');
        $this->table($headers, [$fields]);
    }

    /**
     * Check if password is vailid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $email, string $password, string $confirmPassword) : bool
    {
        return $this->existEmail($email) && $this->isEmail($email) && $this->isRequiredLength($password) &&
        $this->isMatch($password, $confirmPassword);
    }
    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return $password === $confirmPassword;
    }
    
    /**
     * Checks if password is longer than 8 characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password) : bool
    {
        return strlen($password) > 7;
    }

    /**
     * Checks if email is valid.
     *
     * @param string $email
     * @return bool
     */
    private function isEmail(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
          
    }

    /**
     * Checks if email is exists.
     *
     * @param string $email
     * @return bool
     */
    private function existEmail(string $email) : bool
    {
        $us = User::where('email', $email)->first();
        if ($us === null) {
            return true;
        }else{
            return false;
        }   
    }

}
