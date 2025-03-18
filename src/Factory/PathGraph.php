<?php
namespace App\Factory;
use App\Graph;
use InvalidArgumentException;

class PathGraph extends Graph {
    public function __construct($numberOfVertices) {
        if ($numberOfVertices < 2) {
            throw new InvalidArgumentException("A full bipartite graph requires at least 2 vertices.");
        }
        parent::__construct("Path $numberOfVertices");
        for ($i = 1; $i <= $numberOfVertices + 1; $i++) {
            $this->addVertexByID("v$i");
        }
        for ($i = 1; $i < $numberOfVertices + 1; $i++) {
            $this->addEdgeByID("v$i", "v" . ($i + 1));
        }
    }
}
?>
