<?php 
namespace App\Factory;
use App\Factory\Path;

class CircuitGraph extends PathGraph {
    public function __construct($n) {
        if ($n < 3) {
            throw new InvalidArgumentException("A circuit requires at least 3 vertices.");
        }

        parent::__construct($n - 1);
        $this->setName("Circuit $n");
        $this->addEdgeByID("v1", "v$n");
    }
}
?>
