<?php

function sumar(int $a, int $b): int {
    return $a + $b;
}
echo sumar(3, 4); // 7

function saludarA(string $nombre = "invitado"): string {
    return "Hola, $nombre";
}
echo saludarA();        // Hola, invitado
echo saludarA("Laura"); // Hola, Laura

function crearUsuario(string $nombre, int $edad = 18, string $pais = "Colombia") {
    return "$nombre, $edad años, $pais";
}
echo crearUsuario(nombre: "Ana", pais: "Perú");

function incrementar(int $n)     { $n++; } // no cambia el original
function incrementarRef(int &$n) { $n++; } // sí cambia

$num = 1;
incrementar($num);    echo $num; // 1
incrementarRef($num); echo $num; // 2

function promedio(float ...$numeros): float {
    return array_sum($numeros) / count($numeros);
}
echo promedio(4, 5, 6); // 5

function esPar(int $n): bool {
    return $n % 2 === 0;
}

function buscarUsuario(int $id): ?string {
    $usuarios = [1 => "Ana", 2 => "Luis"];
    return $usuarios[$id] ?? null;
}

// Varios valores mediante un array
function minMax(array $datos): array {
    return ['min' => min($datos), 'max' => max($datos)];
}
$r = minMax([4, 9, 1, 7]);
echo "Mínimo: {$r['min']}, Máximo: {$r['max']}";

$doble = fn($x) => $x * 2;
echo $doble(5); // 10

print_r(array_map(fn($n) => $n ** 2, [1, 2, 3])); // [1, 4, 9]

