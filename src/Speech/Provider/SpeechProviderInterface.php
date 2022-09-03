<?php

declare(strict_types=1);

namespace App\Speech\Provider;

interface SpeechProviderInterface
{
    public function provideSpeech(): string;
}
