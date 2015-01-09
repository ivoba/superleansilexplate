<?php

namespace Superleansilexplate\Command;


use Knp\Command\Command;
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
        $this->setName('hello-world')
             ->setDescription('Says: Hello World')
             ->setHelp('Usage: <info>console hello-world</info>')
             ->addOption(
             'env',
             null,
             InputOption::VALUE_OPTIONAL,
             'env?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->write("Hello World ...\n");
        
    }
} 
