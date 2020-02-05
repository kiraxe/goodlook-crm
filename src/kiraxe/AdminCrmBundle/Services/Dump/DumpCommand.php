<?php


namespace kiraxe\AdminCrmBundle\Services\Dump;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;




class DumpCommand extends Command
{
    protected $progect_dir;

    public function __construct($name = null, $progect_dir)
    {
        parent::__construct($name);
        $this->progect_dir = $progect_dir;
    }

    protected function configure()
    {
        $this
            ->setName('mysql:dump')
            ->setDescription('Create dump file');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $basePath = $this->progect_dir;

        $message = exec('bash '.$basePath.'/dump.sh');

        $output->writeln($message);
    }
}