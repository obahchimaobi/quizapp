<?php

namespace App\Filament\Member\Resources;

use App\Filament\Member\Resources\SubscriptionsResource\Pages;
use App\Models\Subscription;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionsResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $activeNavigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationLabel = 'Course Activation';

    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_active', true);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold)
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('description'),
                    ])->from('lg'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('activate')
                ->label(fn($record) :string => auth()->user()->certifications_owned()->where('id', $record->id)->exists() ? 'Deactivate' : 'Activate')
                ->requiresConfirmation()
                ->button()
                ->icon('heroicon-m-star')
                ->action(function ($record) {
                    if(auth()->user()->certifications_owned()->where('id', $record->id)->exists()){
                        auth()->user()->certifications_owned()->detach($record->id);
                        Notification::make()
                            ->danger()
                            ->title('Deactivation Successful!')
                            ->body('You have successfully deactivated ' . $record->name)
                            ->send();
                    }
                    else{
                        auth()->user()->certifications_owned()->attach($record->id);
                        Notification::make()
                        ->success()
                        ->title('Activation Successful!')
                        ->body('You have successfully activated ' . $record->name)
                        ->send();
                    }
                }),

            ])
            ->bulkActions([
            ]);
    }


        public static function infolist(Infolist $infolist): Infolist
        {
            return $infolist
                ->schema([
                    Infolists\Components\TextEntry::make('name'),
                    Infolists\Components\TextEntry::make('is_active')
                    ->badge()
                    ->label('Status'),
                    Infolists\Components\TextEntry::make('description'),
                    Infolists\Components\TextEntry::make('details')
                        ->markdown()
                        ->columnSpanFull(),

                    Infolists\Components\TextEntry::make('created_at')
                        ->label('Created On')
                        ->since(),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label('Last Updated On')
                        ->since(),

                ]);
        }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'view' => Pages\ViewSubscriptions::route('/{record}'),
        ];
    }
}
