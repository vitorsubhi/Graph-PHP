<?php
namespace App\Factory;
use App\Graph;
use InvalidArgumentException;

class WheelGraph extends Graph {
    public function __construct($numberOfVertices) {
        if ($numberOfVertices < 4) {
            throw new InvalidArgumentException("A wheel graph requires at least 4 vertices.");
        }

        parent::__construct("Wheel $numberOfVertices");

        // Add the central vertex (hub)
        $this->addVertexByID("v1");

        // Add outer vertices and edges
        for ($i = 2; $i <= $numberOfVertices; $i++) {
            $this->addVertexByID("v$i");
            $this->addEdgeByID("v$i", "v1"); // Connect to the hub

            // Connect to the next outer vertex (or wrap around to the first outer vertex)
            $nextOuterVertex = ($i < $numberOfVertices) ? $i + 1 : 2;
            $this->addEdgeByID("v$i", "v$nextOuterVertex");
        }
    }
}
?>
