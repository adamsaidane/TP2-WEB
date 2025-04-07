<?php
class Student {
    public $name;
    public $grades;

    public function __construct($name, $grades) {
        $this->name = $name;
        $this->grades = $grades;
    }

    public function displayGrades() {
        foreach ($this->grades as $grade) {
            $class = '';
            if ($grade < 10) {
                $class = 'bg-danger text-white';
            } elseif ($grade > 10) {
                $class = 'bg-success text-white';
            } else {
                $class = 'bg-warning';
            }

            echo "<div class='p-2 $class border border-light'>$grade</div>";
        }
    }

    public function average() {
        return round(array_sum($this->grades) / count($this->grades), 2);
    }

    public function isAdmitted() {
        return $this->average() >= 10 ? 'admis' : 'non admis';
    }
}
?>
