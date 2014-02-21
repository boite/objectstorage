<?php

namespace LinkORB\Component\ObjectStorage\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LinkORB\Component\ObjectStorage\Utils;

class DeleteCommand extends Command
{

    protected function configure()
    {
        $this->setName('objectstorage:delete')
            ->setDescription(
                'Delete a key from objectstorage'
            )
            ->addOption(
                'config',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Config filename'
            )
            ->addArgument(
                'key',
                InputArgument::REQUIRED,
                'The key of the file in objectstorage'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configfilename = $input->getOption('config');
        $config = Utils::loadConfig($configfilename);
        $client = Utils::getClientFromConfig($config);

        $key = $input->getArgument('key');

        $output->writeln("Deleting key '" . $key . "'\n");
        $client->delete($key);
        $output->writeln("Done");
    }
}
