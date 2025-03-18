<?php
namespace App\Factory;
use App\Graph;
use App\Vertex;
use InvalidArgumentException;

class FullBipartiteGraph extends Graph {
    public function __construct($numberOfVertices) {
        if ($numberOfVertices < 2) {
            throw new InvalidArgumentException("A full bipartite graph requires at least 2 vertices.");
        }

        parent::__construct("Full Bipartite $numberOfVertices");

        // Determine the partition sizes
        $partition1Size = rand(1, $numberOfVertices - 1);

        // Add vertices to partition 1 (blue)
        for ($i = 1; $i <= $partition1Size; $i++) {
            $vertex = new Vertex("v$i", '#0000FF'); // Blue
            $this->addVertex($vertex);
        }

        // Add vertices to partition 2 (red)
        for ($i = $partition1Size + 1; $i <= $numberOfVertices; $i++) {
            $vertex = new Vertex("v$i", '#FF0000'); // Red
            $this->addVertex($vertex);
        }

        // Add edges between the two partitions
        for ($i = 1; $i <= $partition1Size; $i++) {
            for ($j = $partition1Size + 1; $j <= $numberOfVertices; $j++) {
                $this->addEdgeByID("v$i", "v$j");
            }
        }
    }
}
?>
