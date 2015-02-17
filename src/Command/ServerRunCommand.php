<?php

namespace Superleansilexplate\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerRunCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDefinition(array(
                                new InputArgument('address', InputArgument::OPTIONAL, 'Address:port', '127.0.0.1:8000'),
                                new InputOption('index', 'i', InputArgument::OPTIONAL, 'Index', 'index'),
                                new InputOption('env', 'e', InputArgument::OPTIONAL, 'Environment', 'dev'),
                             ))
            ->setName('server:run')
            ->setDescription('Runs PHP built-in web server')
            ->setHelp(<<<EOF
The <info>%command.name%</info> runs PHP built-in web server:

  <info>%command.full_name%</info>

To change default bind address and port use the <info>address</info> argument:

  <info>%command.full_name% 127.0.0.1:8000</info>

To change default index use the <info>--index</info> option:

  <info>%command.full_name% --index=api</info>

To set the environment use <info>--env</info> option, dev is default:

  <info>%command.full_name% --env=prod</info>

See also: http://www.php.net/manual/en/features.commandline.webserver.php

EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
         * web or api ?
         * env
         * address
         */
        $output->writeln(sprintf("Server running on <info>http://%s</info>\n", $input->getArgument('address')));
        $output->writeln('Quit the server with CONTROL-C.');

        $env = '';
        if($input->getOption('env') == 'prod'){
            $env = 'SILEX_ENV=prod';
        }
        exec($env . ' php -d variables_order=EGPCS -S '.$input->getArgument('address').' -t web web/'.$input->getOption('index').'.php');
    }
}