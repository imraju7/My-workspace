<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected $password;

    protected function beforeCreate(): void
    {
        // Runs before the form fields are saved to the database.
        $this->password = $this->data['password'];
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        Log::info($this->password);
        Mail::to($this->data['email'])->send(new UserRegistered($this->password));
    }
}
