<?php

namespace App\Service;

interface CapitaleInterface {
    public function paysAleatoire(): string;
    public function testPays(string $pays, string $reponse): string;
}