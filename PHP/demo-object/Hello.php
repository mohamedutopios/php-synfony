<?php

trait Hello {
    public function SayHello() {
        echo "Hello from ".$this->getFirstname();
    }
}