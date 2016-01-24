<?php

namespace Superleansilexplate\Command;


use Ivoba\Silex\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{

    function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('silex:hello-world')
             ->setDescription('Says: Hello World')
             ->setHelp('Usage: <info>console hello-world</info>');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write("Hello World ...\n");
    }
} 
