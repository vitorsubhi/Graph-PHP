<?php
namespace App\Factory;
use App\Graph;

class FullBipartiteGraph extends Graph {
    public function __construct($n) {
        if ($n < 2) {
            throw new InvalidArgumentException("A full bipartite graph requires at least 2 vertices.");
        }

        parent::__construct("Full Bipartite $n");

        // Determine the partition sizes
        $partition1Size = rand(1, $n - 1);
        $partition2Size = $n - $partition1Size;

        // Add vertices to the graph
        for ($i = 1; $i <= $n; $i++) {
            $this->addVertexByID("v$i");
        }

        // Add edges between the two partitions
        for ($i = 1; $i <= $partition1Size; $i++) {
            for ($j = $partition1Size + 1; $j <= $n; $j++) {
                $this->addEdgeByID("v$i", "v$j");
            }
        }
    }
}
?>
