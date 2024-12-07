<?php

namespace App\Service;

class DemoService implements DemoInterface {

    public function getInfo():string {
        return "Information from demoService";
    }
}