#!/usr/bin/env php
<?php

set_time_limit(0);

use Desarrolla2\RSSClient\RSSClient;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$app = require __DIR__.'/bootstrap.php';

$console = $app['console'];

$console->register( 'refresh-rss' )
	->setDescription('Crawl all RSS feed in order to find news')
	->setHelp('Usage: <info>.app/console refresh-rss</info>')
	->setCode(
	function(InputInterface $input, OutputInterface $output) use ($app)
	{
		$output->writeln('Coucou');
	}
);

$console->run();

?>