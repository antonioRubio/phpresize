<?php

require_once 'FileSystem.php';
class Resizer {

    private $path;
    private $configuration;
    private $fileSystem;

    public function __construct($path, $configuration=null)
    {
        if (is_null($configuration))
            $configuration = new Configuration();
        $this->checkPath($path);
        $this->checkConfiguration($configuration);
        $this->path = $path;
        $this->configuration = $configuration;
        $this->fileSystem = new FileSystem();
    }

    public function injectFileSystem(FileSystem $fileSystem) {
        $this->fileSystem = $fileSystem;
    }

    public function obtainFilePath() {
        $imagePath = '';
        if($this->path->isHttpProtocol()):
            $filename = $this->path->obtainFilename();
            $local_file_path = $this->configuration->obtainRemote() .$filename;
            $download_image = true;
            if($this->fileSystem->file_exists($local_file_path)):
                $opts = $this->configuration->asHash();
                if($this->fileSystem->filemtime($local_file_path) < strtotime('+'.$opts['cache_http_minutes'].' minutes')):
                    $download_image = false;
                endif;
            endif;
            if($download_image == true):
                $img = $this->fileSystem->file_get_contents($imagePath);
                $this->fileSystem->file_put_contents($local_file_path,$img);
            endif;
            $imagePath = $local_file_path;
        endif;
        return $imagePath;
    }

    /**
     * @param $path
     */
    private function checkPath($path)
    {
        if ( ! ($path instanceof ImagePath)) throw new InvalidArgumentException();
    }

    /**
     * @param $configuration
     */
    private function checkConfiguration($configuration)
    {
        if ( ! ($configuration instanceof Configuration)) throw new InvalidArgumentException();
    }
}