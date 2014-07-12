<?php

namespace Terramar\Packages\Job;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\ProcessBuilder;

class UpdateAndBuildJob extends ContainerAwareJob
{
    public function run($args)
    {
        $finder = new PhpExecutableFinder();
        $builder = new ProcessBuilder(array('bin/console', 'satis:update', '--build'));
        $builder->setEnv('HOME', $this->getContainer()->getParameter('app.root_dir'));
        $builder->setPrefix($finder->find());
        
        $process = $builder->getProcess();
        $process->run(function($type, $message) {
            echo $message;
        });
    }
}