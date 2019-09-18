<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:change-password'; //Command will be called as php artisan register:change-password

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change a user password';

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
    public function __construct(User $user)
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
        $admin = $this->user->changePassword($details);
        $this->display();
    }

    /**
     * Ask for user details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $details['email'] = $this->ask('Email');
        $details['current_password'] = $this->secret('Current Password');
        $details['password'] = $this->secret('New Password');
        $details['confirm_password'] = $this->secret('Confirm password');
        while (! $this->isValid($details['email'], $details['current_password'], $details['password'], $details['confirm_password'])) {
            if (! $this->existAccount($details['email'], $details['current_password'])) {
                $this->error('Email and password do not match our records.');
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
            $details['current_password'] = $this->secret('Current Password');
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
    private function display() : void
    {
        $this->info('Your password has been updated.');
    }

    /**
     * Check if password is vailid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValid(string $email, string $current_password, string $password, string $confirmPassword) : bool
    {
        return $this->existAccount($email, $current_password) && $this->isRequiredLength($password) && $this->isMatch($password, $confirmPassword);
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
     * Checks if account is exists.
     *
     * @param string $email
     * @param string $current_password
     * @return bool
     */
    private function existAccount(string $email, string $current_password) : bool
    {
        $us = User::where('email', $email)->first();
        if ($us === null) {
            return false;
        }else{
            if(Hash::check($current_password, $us->password)){
                return true;
            }else{
                return false;
            }
        }   
    }
}
