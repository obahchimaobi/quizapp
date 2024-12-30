<?php

namespace App\Filament\Pages\Auth;

use Closure;
use App\Models\Codes;
use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Illuminate\Auth\Events\Registered;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as AuthRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Register extends AuthRegister
{
    public function register(): ?RegistrationResponse
    {
        // try {
        //     $this->rateLimit(2);
        // } catch (TooManyRequestsException $exception) {
        //     Notification::make()
        //         ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
        //             'seconds' => $exception->secondsUntilAvailable,
        //             'minutes' => ceil($exception->secondsUntilAvailable / 60),
        //         ]))
        //         ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
        //             'seconds' => $exception->secondsUntilAvailable,
        //             'minutes' => ceil($exception->secondsUntilAvailable / 60),
        //         ]) : null)
        //         ->danger()
        //         ->send();

        //     return null;
        // }

        $data = $this->form->getState();

        $user = $this->getUserModel()::create($data);

        $user->assignRole('user');

        app()->bind(
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        );
        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCodeFormComponenet(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getCodeFormComponenet(): Component
    {
        return TextInput::make('code')
            ->required()
            ->rules([
                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                    if (!Codes::where('code', $value)->exists()) {
                        $fail('The :attribute is invalid.');
                    }
                },

                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                    if (Codes::where('code', $value)->where('is_used', true)->exists()) {
                        $fail('The :attribute has already been used.');
                    }
                },
            ])
            ->hint(new HtmlString('<a href="https://wa.link/zvrmwl">Don\'t have a code? Buy One</a>'))
            ->hintColor('primary');
    }
}
