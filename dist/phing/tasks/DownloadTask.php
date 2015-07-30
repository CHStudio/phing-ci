<?php
/**
 * Phing Task: Download a file to the given path
 *
 * @author Stéphane HULARD <s.hulard@chstudio.fr>
 * @copyright Agence Interactive 2015
 */
class DownloadTask extends Task
{
	private $url;
	private $path;

	/**
	 * Task Launcher
	 * @return void
	 */
	public function main()
	{
		$h = fopen($this->path, 'w');

		$handle = curl_init($this->url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_FILE, $h);
		curl_exec($handle);
		$status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);

		if( $status != 200 ) {
			unlink($this->path);
			throw new Exception("Can't download the file !");
		}

		$this->log( 'File successfully downloaded: '.$this->url );
	}

	/**
	 * Init url property
	 * @param string $url
	 * @return void
	 */
	public function setUrl( $url ) {
		if( !filter_var($url, FILTER_VALIDATE_URL) ) {
			throw new Exception('Invalid URL given!');
		}
		$this->url = $url;
	}
	/**
	 * Init path property
	 * @return void
	 */
	public function setPath( $path ) {
		$path = !is_dir(dirname($path))?$this->location.DIRECTORY_SEPARATOR.$path:$path;
		if( !is_dir(dirname($path)) ) {
			throw new Exception('Invalid path given!');
		}
		if( is_file($path) ) {
			throw new Exception('The destination path already exists!');
		}
		$this->path = $path;
	}
}