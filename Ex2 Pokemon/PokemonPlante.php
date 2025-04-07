<?php
require_once 'Pokemon.php';

class PokemonPlante extends Pokemon {
    public function attack($opponent) {
        $damage = $this->attackPokemon->getDamage();
        if ($opponent instanceof PokemonEau) {
            $damage *= 2;
        }
        elseif($opponent instanceof PokemonPlante || $opponent instanceof PokemonFeu){
          $damage *= 0.5;
        }
        $opponent->hp -= $damage;
        if ($opponent->hp < 0) $opponent->hp = 0;

        echo "<p style='color:red'>{$this->name} (Feu) attaque {$opponent->name} et inflige {$damage} dégâts.</p>";

        if ($opponent->isDead()) {
            echo "<p><strong>{$opponent->name} est KO !</strong></p>";
        }
    }
}
