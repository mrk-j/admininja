<?php namespace Mrkj\Admininja\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admininja:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish the admininja assets';

	/** @var Filesystem $fs */
	protected $files;

	protected $publishPath;

	/**
	 * Create a new Publish command
	 *
	 * @param \Illuminate\Filesystem\Filesystem $files
	 * @param string $publishPath
	 */
	public function __construct($files, $publishPath)
	{
		parent::__construct();

		$this->files = $files;
		$this->publishPath = $publishPath;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$package = 'mrkj/admininja';

		$source = __DIR__ . '/../../../assets/';
		$destination = $this->publishPath . '/packages/' . $package;

		if($this->files->isDirectory($destination))
		{
			$deleted = $this->files->deleteDirectory($destination);

			if($deleted)
			{
				$this->info('Cleaned up previous published assets for ' . $package);
			}
			else
			{
				$this->error('Could not clean up previous published assets for ' . $package);
			}
		}

		$copiedFiles = $this->files->copyDirectory($source, $destination);

		if ($copiedFiles)
		{
			$this->info('Published assets to: ' . $destination);
		}
		else
		{
			$this->error('Could not publish all assets for ' . $package);
		}
	}

}
