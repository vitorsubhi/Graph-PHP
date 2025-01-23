<?php
namespace App\Factory;
use App\Graph;

class CompleteGraph extends Graph {
    public function __construct($n) {
        parent::__construct("K $n");
        for ($i = 1; $i <= $n; $i++) {
            $this->addVertexByID("v$i");
        }
        for ($i = 1; $i < $n; $i++) {
            for ($j = $i + 1; $j <= $n; $j++) {
                $this->addEdgeByID("v$i", "v$j");
            }
        }
    }
}
?>
