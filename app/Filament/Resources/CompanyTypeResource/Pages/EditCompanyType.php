<?php

namespace App\Filament\Resources\CompanyTypeResource\Pages;

use App\Filament\Resources\CompanyTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\CompanyType;

class EditCompanyType extends EditRecord
{
    protected static string $resource = CompanyTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->hidden(fn (CompanyType $record): bool => $record->company()->exists()),
        ];
    }
}
