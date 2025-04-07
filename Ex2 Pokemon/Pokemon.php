<?php
require_once 'AttackPokemon .php';

class Pokemon {
    public $name;
    public $url;
    public $hp;
    public $attackPokemon;

    public function __construct($name, $url, $hp, $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function isDead() {
        return $this->hp <= 0;
    }

    public function attack($opponent) {
        $damage = $this->attackPokemon->getDamage();
        $opponent->hp -= $damage;
        echo "<p>{$this->name} attaque {$opponent->name} et inflige {$damage} dégâts.</p>";
        if ($opponent->isDead()) {
            echo "<p>{$opponent->name} est KO !</p>";
        }
    }

public function whoAmI() {
    echo "<h3>{$this->name}</h3>";
    echo "<img src='{$this->url}' width='150'>";
    echo "<p><strong>HP :</strong> {$this->hp}</p>";
    echo "<p><strong>Attaque min :</strong> {$this->attackPokemon->attackMinimal}</p>";
    echo "<p><strong>Attaque max :</strong> {$this->attackPokemon->attackMaximal}</p>";
    echo "<p><strong>Attaque spéciale (x):</strong> {$this->attackPokemon->specialAttack}</p>";
    echo "<p><strong>Chance attaque spéciale :</strong> {$this->attackPokemon->probabilitySpecialAttack}%</p>";
}
}
