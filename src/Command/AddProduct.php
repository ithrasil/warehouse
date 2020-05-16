<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddProduct extends Command
{
    protected function configure()
    {
        $this->setName('app:add-product');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }

    private function addUser(OutputInterface $output)
    {

    }
}
