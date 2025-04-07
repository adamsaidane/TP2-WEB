<?php
class AttackPokemon {
    public $attackMinimal;
    public $attackMaximal;
    public $specialAttack;
    public $probabilitySpecialAttack;

    public function __construct($min, $max, $special, $prob) {
        $this->attackMinimal = $min;
        $this->attackMaximal = $max;
        $this->specialAttack = $special;
        $this->probabilitySpecialAttack = $prob;
    }

    public function getDamage() {
        $normal = rand($this->attackMinimal, $this->attackMaximal);
        $isSpecial = rand(1, 100) <= $this->probabilitySpecialAttack;
        return $isSpecial ? $normal * $this->specialAttack : $normal;
    }
}
