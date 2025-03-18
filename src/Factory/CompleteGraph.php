<?php
namespace App\Factory;
use App\Graph;

class CompleteGraph extends Graph {
    public function __construct($numberOfVertices) {
        parent::__construct("K $numberOfVertices");
        for ($i = 1; $i <= $numberOfVertices; $i++) {
            $this->addVertexByID("v$i");
        }
        for ($i = 1; $i < $numberOfVertices; $i++) {
            for ($j = $i + 1; $j <= $numberOfVertices; $j++) {
                $this->addEdgeByID("v$i", "v$j");
            }
        }
    }
}
?>
