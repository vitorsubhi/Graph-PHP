<?php
namespace App\Factory;
use App\Graph;

class TreeGraph extends Graph {
    public function __construct($n) {
        if ($n < 1) {
            throw new InvalidArgumentException("A tree requires at least 1 vertex.");
        }

        parent::__construct("Tree $n");

        // Add the root vertex
        $this->addVertexByID("v1");

        // Add remaining vertices and connect each to a random existing vertex
        for ($i = 2; $i <= $n; $i++) {
            $this->addVertexByID("v$i");
            $parentVertex = rand(1, $i - 1); // Randomly select an existing vertex as the parent
            $this->addEdgeByID("v$parentVertex", "v$i");
        }
    }
}
?>
