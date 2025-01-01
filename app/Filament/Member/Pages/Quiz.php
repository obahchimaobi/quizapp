<?php

namespace App\Filament\Member\Pages;


use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Quiz extends Page
{

    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';
    protected static ?string $activeNavigationIcon = 'heroicon-s-cursor-arrow-rays';

    protected static ?string $title = 'Start Quiz';

    protected static string $view = 'filament.member.pages.quiz';

    protected static ?int $navigationSort = 1;

}
