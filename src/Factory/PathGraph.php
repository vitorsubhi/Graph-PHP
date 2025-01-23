<?php
namespace App\Factory;
use App\Graph;

class PathGraph extends Graph {
    public function __construct($n) {
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
