<?php
declare(strict_types=1);

function sumar(int $a, int $b): void {
    echo "La suma es: " . ($a + $b) . PHP_EOL;
}

sumar(8, 5);