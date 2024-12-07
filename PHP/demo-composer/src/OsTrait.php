<?php

namespace Administrateur\DemoComposer;

trait OsTrait {
    protected function exists() {
        return file_exists($this->path);
    }
}