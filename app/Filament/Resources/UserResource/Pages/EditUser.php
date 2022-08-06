<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()->action(function (array $data): void {
                if ($this->record->candidate()->exists()) {
                    $this->record->candidate()->delete();
                }
                if ($this->record->customer()->exists()) {
                    if ($this->record->customer()->vacancy()->exists()) {
                        $this->record->customer()->vacancy()->delete();
                    }
                    $this->record->customer()->delete();
                }
                if ($this->record->application()->exists()) {
                    $this->record->application()->delete();
                }
                $this->record->delete();
            }),
        ];
    }
}
