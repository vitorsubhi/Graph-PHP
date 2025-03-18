<?php
namespace App\Factory;

use App\Graph;
use App\Vertex;
use InvalidArgumentException;

class KPartiteGraph extends Graph {
    public function __construct(int $totalNodes, int $numberOfPartitions) {
        $this->validateInput($totalNodes, $numberOfPartitions);
        parent::__construct("K-Partite Graph");
        
        $partitions = $this->generatePartitions($totalNodes, $numberOfPartitions);
        $this->connectPartitions($partitions);
    }

    private function validateInput(int $totalNodes, int $numberOfPartitions): void {
        if ($numberOfPartitions < 2) {
            throw new InvalidArgumentException("A K-partite graph requires at least 2 partitions.");
        }
        if ($totalNodes < $numberOfPartitions) {
            throw new InvalidArgumentException("The total number of nodes must be greater than or equal to the number of partitions.");
        }
    }

    private function generatePartitions(int $totalNodes, int $numberOfPartitions): array {
        $partitions = [];
        $vertexCounter = 1;
        $baseSize = intdiv($totalNodes, $numberOfPartitions);
        $extraNodes = $totalNodes % $numberOfPartitions;
        $partitionColors = $this->generatePartitionColors($numberOfPartitions);
        
        for ($i = 0; $i < $numberOfPartitions; $i++) {
            $partitionSize = $baseSize + ($i < $extraNodes ? 1 : 0);
            $partitions[] = $this->createPartition($partitionSize, $partitionColors[$i], $vertexCounter);
        }
        
        return $partitions;
    }

    private function generatePartitionColors(int $numberOfPartitions): array {
        return array_map(fn() => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), range(0, $numberOfPartitions - 1));
    }

    private function createPartition(int $size, string $color, int &$vertexCounter): array {
        $partition = [];
        
        for ($j = 0; $j < $size; $j++) {
            $vertexID = "v$vertexCounter";
            $vertex = new Vertex($vertexID, $color);
            $this->addVertex($vertex);
            $partition[] = $vertexID;
            $vertexCounter++;
        }
        
        return $partition;
    }

    private function connectPartitions(array $partitions): void {
        $totalPartitions = count($partitions);
        
        for ($i = 0; $i < $totalPartitions - 1; $i++) {
            for ($j = $i + 1; $j < $totalPartitions; $j++) {
                foreach ($partitions[$i] as $v1) {
                    foreach ($partitions[$j] as $v2) {
                        $this->addEdgeByID($v1, $v2);
                    }
                }
            }
        }
    } 
}
?>