<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

#[AsCommand('speak')]
class SpeakCommand extends Command
{
    protected function configure(): void
    {
        $this->setDefinition([new InputArgument('speech', InputArgument::REQUIRED)]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = Process::fromShellCommandline(
            sprintf('gtts-cli "%s" --lang ru | play -t mp3 - > /dev/null 2>&1', $input->getArgument('speech'))
        );
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return Command::SUCCESS;
    }
}
