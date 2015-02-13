<?php

namespace Superleansilexplate\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

class ClearCacheCommand extends Command
{
    private $cachePath;

    function __construct($cachePath)
    {
        $this->cachePath = $cachePath;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('cache:clear')
             ->setDescription('clear the cache')
             ->setHelp('Usage: <info>clear the cache</info>');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = Finder::create()->in($this->cachePath)->notName('.gitkeep');
        $filesystem = new Filesystem();
        $filesystem->remove($finder);
        $output->writeln(sprintf("%s <info>success</info>", 'cache:clear'));
    }
}