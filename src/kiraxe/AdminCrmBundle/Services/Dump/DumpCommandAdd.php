<?php


namespace kiraxe\AdminCrmBundle\Services\Dump;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;




class DumpCommandAdd extends Command
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
            ->setName('mysql:AddDump')
            ->setDescription('Create dump file')
            ->addArgument('filename', InputArgument::REQUIRED, 'filename');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $basePath = $this->progect_dir;

        $filename = $input->getArgument('filename');

        $message=shell_exec('bash '.$basePath."/addDump.sh $filename");

        /*if ($output->isDebug()) {
            $output->writeln([$message]);
        }

        if ($output->isVerbose()) {
            $output->writeln([$message]);
        }*/

        $output->writeln([$message]);
    }
}