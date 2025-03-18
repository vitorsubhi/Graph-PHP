<?php 
namespace App\Factory;
use App\Factory\Path;
use InvalidArgumentException;

class CircuitGraph extends PathGraph {
    public function __construct($numberOfVertices) {
        if ($numberOfVertices < 3) {
            throw new InvalidArgumentException("A circuit requires at least 3 vertices.");
        }

        parent::__construct($numberOfVertices - 1);
        $this->setName("Circuit $numberOfVertices");
        $this->addEdgeByID("v1", "v$numberOfVertices");
    }
}
?>
