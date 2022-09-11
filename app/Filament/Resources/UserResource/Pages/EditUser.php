<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserBanned;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Customer;
use App\Models\Vacancy;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['is_banned']) {
            Mail::to($this->data['email'])->send(new UserBanned($this->data['name']));
        }
        return $data;
    }

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Action::make('Send Password Reset Link')
                ->requiresConfirmation()
                ->action(function (): void {
                    $token = Str::random(64);

                    DB::table('password_resets')->insert([
                        'email' => $this->record->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);

                    Mail::send('email.forgotpassword', ['token' => $token], function ($message) use ($token) {
                        $message->to($this->record->email);
                        $message->subject('Reset Password');
                    });
                    Notification::make()
                        ->title('Password Reset Mail sent successfully')
                        ->success()
                        ->send();
                }),
            Actions\DeleteAction::make()->action(function (): void {
                Candidate::where('user_id', $this->record->id)->delete();
                Application::where('user_id', $this->record->id)->delete();
                $customer = customer::where('user_id', $this->record->id)->first();
                if ($customer) {
                    $vacancies = Vacancy::where('customer_id', $customer->id)->get()->pluck('id');
                    Application::whereIn('vacancy_id', $vacancies)->delete();
                    Vacancy::where('customer_id', $customer->id)->delete();
                    $customer->delete();
                }
                $this->record->delete();
                Notification::make()
                    ->title('Deleted successfully')
                    ->success()
                    ->send();
            }),
        ];
    }
}
