<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('speak')]
class SpeakCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        exec('gtts-cli "Привет мир!" --lang ru | play -t mp3 - > /dev/null 2>&1');

        return Command::SUCCESS;
    }
}
