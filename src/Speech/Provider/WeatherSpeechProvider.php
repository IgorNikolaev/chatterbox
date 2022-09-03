<?php

declare(strict_types=1);

namespace App\Speech\Provider;

class WeatherSpeechProvider implements SpeechProviderInterface
{
    public function provideSpeech(): string
    {
        return 'Сегодня отличная погода!';
    }
}
