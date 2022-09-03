<?php

declare(strict_types=1);

namespace App\Command;

use App\Speech\Provider\SpeechProviderInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

#[AsCommand('speak')]
class SpeakCommand extends Command
{
    private readonly SpeechProviderInterface $speechProvider;

    public function __construct(SpeechProviderInterface $speechProvider)
    {
        parent::__construct();

        $this->speechProvider = $speechProvider;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = Process::fromShellCommandline(
            sprintf('gtts-cli "%s" --lang ru | play -t mp3 - > /dev/null 2>&1', $this->speechProvider->provideSpeech())
        );
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return Command::SUCCESS;
    }
}
