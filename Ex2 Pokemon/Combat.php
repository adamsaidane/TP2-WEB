<?php
require_once 'Pokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';

$atk1 = new AttackPokemon(10, 20, 2, 30);
$atk2 = new AttackPokemon(15, 25, 3, 20);

$p1 = new PokemonFeu("Pokemon 1", "https://img.pokemondb.net/artwork/charizard.jpg", 100, $atk1);
$p2 = new PokemonEau("Pokemon 2", "https://img.pokemondb.net/artwork/blastoise.jpg", 100, $atk2);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pokémon Battle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2> Pokémon Battle Arena </h2>

<div class="container">
    <div class="card">
        <?php $p1->whoAmI(); ?>
    </div>
    <div class="card">
        <?php $p2->whoAmI(); ?>
    </div>
</div>

<div class="PlaceForContenu">
    <?php
    $round = 1;
    while (!$p1->isDead() && !$p2->isDead()) {
        echo "<h4>Round $round</h4>";
        $p1->attack($p2);
        if (!$p2->isDead()) {
            $p2->attack($p1);
        }
        $round++;
    }
    echo "<h2>Battle Over!</h2>";
    if ($p1->isDead()) {
        echo "<b>{$p2->name} wins with {$p2->hp} HP left!</b>";
    } else {
        echo "<b>{$p1->name} wins with {$p1->hp} HP left!</b>";
    }
    ?>
</div>

</body>
</html>
