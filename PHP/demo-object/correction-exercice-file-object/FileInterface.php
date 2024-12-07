<?php 

namespace App;

interface FileInterface {
    public function read();
    public function write($content);
    public function delete();
}