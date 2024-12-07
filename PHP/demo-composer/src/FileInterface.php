<?php 

namespace Administrateur\DemoComposer;

interface FileInterface {
    public function read();
    public function write($content);
    public function delete();
}