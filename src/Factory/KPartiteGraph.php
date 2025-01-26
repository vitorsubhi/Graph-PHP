<?php
namespace App\Factory;

use App\Graph;
use App\Vertex;
use InvalidArgumentException;

class KPartiteGraph extends Graph {
    public function __construct(int $totalNodes, int $numPartitions) {
        if ($numPartitions < 2) {
            throw new InvalidArgumentException("A K-partite graph requires at least 2 partitions.");
        }
        if ($totalNodes < $numPartitions) {
            throw new InvalidArgumentException("The total number of nodes must be greater than or equal to the number of partitions.");
        }

        parent::__construct("K-Partite Graph");

        $partitions = [];
        $vertexCounter = 1;

        $baseSize = intdiv($totalNodes, $numPartitions);
        $extraNodes = $totalNodes % $numPartitions;
        
        $partitionColors = [];
        for ($i = 0; $i < $numPartitions; $i++) {
            $partitionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Generate a random color
        }

        for ($i = 0; $i < $numPartitions; $i++) {
            $currentPartition = [];
            $partitionSize = $baseSize + ($i < $extraNodes ? 1 : 0); // Distribute remaining nodes
            $color = $partitionColors[$i];

            for ($j = 0; $j < $partitionSize; $j++) {
                $vertexID = "v$vertexCounter";
                $vertex = new Vertex($vertexID, $color); // Assign color to the vertex
                $this->addVertex($vertex); // Add vertex to the graph 
                $currentPartition[] = $vertexID;
                $vertexCounter++;
            }
            $partitions[] = $currentPartition;
        }

        foreach ($partitions as $partIndex => $part) {
            for ($i = $partIndex + 1; $i < count($partitions); $i++) {
                foreach ($part as $v1) {
                    foreach ($partitions[$i] as $v2) {
                        $this->addEdgeByID($v1, $v2);
                    }
                }
            }
        }
    }
}
?>