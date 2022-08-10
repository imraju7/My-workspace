<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected $password;
    protected $email;

    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
        $this->password = $this->data['password'];
        $this->email = $this->data['email'];
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        User::where('email', $this->email)->update([
            'email_verified_at' => now()
        ]);
        Mail::to($this->data['email'])->send(new UserRegistered($this->email, $this->password));
    }
}
