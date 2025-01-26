<?php
namespace App\Factory;
use App\Graph;
use InvalidArgumentException;

class PathGraph extends Graph {
    public function __construct($n) {
        if ($n < 2) {
            throw new InvalidArgumentException("A full bipartite graph requires at least 2 vertices.");
        }
        parent::__construct("Path $n");
        for ($i = 1; $i <= $n + 1; $i++) {
            $this->addVertexByID("v$i");
        }
        for ($i = 1; $i < $n + 1; $i++) {
            $this->addEdgeByID("v$i", "v" . ($i + 1));
        }
    }
}
?>
