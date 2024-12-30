<?php

namespace App\Filament\Resources\CodeResource\Pages;

use App\Filament\Resources\CodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageCodes extends ManageRecords
{
    protected static string $resource = CodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
{
    return [
        'All' => Tab::make(),
        'Used' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_used', true)),
        'Not Used' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_used', false)),
    ];
}
}
