<?php
declare(strict_types= 1);

function calcularIVA(float $precio, float $tasa = 0.19): float {
    return round($precio * (1 + $tasa), 2);
}

function formatearPrecio(float $valor): string {
    return '$' . number_format($valor, 0, ',', '.');
}

echo formatearPrecio(calcularIVA(50000)) . "\n";        // IVA del 19 %
echo formatearPrecio(calcularIVA(50000, 0.05)) . "\n";  // IVA del 5 %


function saludarCliente(string $nombre = "cliente"): string {

    return "Bienvenido a la tienda, " . $nombre;

}

echo saludarCliente("Tomas");

echo "<br>";

echo saludarCliente();
function aplicarDescuento(float $precio, float $porcentaje = 0): float {
    return $precio - ($precio * $porcentaje / 100);
}

echo formatearPrecio(aplicarDescuento(precio: 80000, porcentaje: 10)) . "\n";

function totalCarrito(float ...$precios): float {
    return array_sum($precios);
}

echo formatearPrecio(totalCarrito(15000, 22000, 8000)) . "\n";

function descontarStock(int &$stock, int $cantidad): void {
    $stock -= $cantidad;
}

$stockCuadernos = 10;
descontarStock($stockCuadernos, 3);
echo "Quedan $stockCuadernos cuadernos\n";

function promedioPrecios(float ...$precios): float {

    $suma = array_sum($precios);

    $promedio = $suma / count($precios);

    return $promedio;

}


echo promedioPrecios(1000, 2500, 3000, 4500, 5000);

$productos = [
    ['nombre' => 'Cuaderno', 'precio' => 8000,  'stock' => 20],
    ['nombre' => 'Lápiz',    'precio' => 1500,  'stock' => 0],
    ['nombre' => 'Mochila',  'precio' => 95000, 'stock' => 4],
];

$nombres = array_column($productos, 'nombre');
echo "Catálogo: " . implode(', ', $nombres) . "\n";
echo "Total de productos: " . count($productos) . "\n";

$disponibles = array_filter($productos, fn($p) => $p['stock'] > 0);
echo "Con stock: " . count($disponibles) . "\n";

$precios = array_column($productos, 'precio');
echo "El más caro cuesta " . formatearPrecio(max($precios)) . "\n";

$productos = [
    ["nombre" => "camisa", "precio" => 20000],
    ["nombre" => "pantalon", "precio" => 50000],
    ["nombre" => "zapatos", "precio" => 80000]
];

// Obtener los precios con IVA incluido

$preciosConIva = array_map(function($producto) {
    return $producto["precio"] * 1.19;
}, $productos);

// Mostrar los precios con IVA

print_r($preciosConIva);

echo "<br>";

// Mostrar los nombres en mayúsculas

$nombres = array_map(function($producto) {
    return strtoupper($producto["nombre"]);
}, $productos);

print_r($nombres);

class ProductoAgotadoException extends Exception {
    public function __construct(string $producto) {
        parent::__construct("No hay unidades suficientes de «$producto».");
    }
}

function buscarProducto(array $productos, string $nombre): array {
    foreach ($productos as $p) {
        if ($p['nombre'] === $nombre) {
            return $p;
        }
    }
    throw new InvalidArgumentException("El producto «$nombre» no existe.");
}

function comprar(array $productos, string $nombre, int $cantidad): float {
    if ($cantidad <= 0) {
        throw new RangeException("La cantidad debe ser mayor que cero.");
    }
    $producto = buscarProducto($productos, $nombre);
    if ($producto['stock'] < $cantidad) {
        throw new ProductoAgotadoException($nombre);
    }
    return calcularIVA($producto['precio'] * $cantidad);
}

try {
    echo formatearPrecio(comprar($productos, 'Lápiz', 1)) . "\n";
} catch (ProductoAgotadoException $e) {
    echo "Aviso: " . $e->getMessage() . "\n";
} catch (InvalidArgumentException | RangeException $e) {
    echo "Pedido inválido: " . $e->getMessage() . "\n";
} finally {
    echo "Consulta finalizada.\n";
}

?>





