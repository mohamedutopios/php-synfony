<?php 

namespace Administrateur\DemoComposer;


class File implements FileInterface {
    use OsTrait;

    public function __construct(private string $path) {
        
    }

    public function read() {
        if(!$this->exists()) {
            throw new \Exception("File not found");
        }
        return file_get_contents($this->path);
    }
    public function write($content) {
        if(strlen($content) == 0) {
            throw new \Exception("length of content file need to be gt 0 char");
        }
        file_put_contents($this->path, $content);
    }
    public function delete() {
        if(!$this->exists()) {
            throw new \Exception("File not found");
        }
        unlink($this->path);
    }
}