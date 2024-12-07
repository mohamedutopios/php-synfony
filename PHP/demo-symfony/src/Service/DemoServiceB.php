<?php

namespace App\Service;

class DemoServiceB implements DemoInterface {

    public function getInfo():string {
        return "Information from demoService B";
    }
}