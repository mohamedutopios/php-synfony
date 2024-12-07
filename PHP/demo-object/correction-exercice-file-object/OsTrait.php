<?php

namespace App;

trait OsTrait {
    protected function exists() {
        return file_exists($this->path);
    }
}