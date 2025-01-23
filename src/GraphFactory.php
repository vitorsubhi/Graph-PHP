<?php
namespace App;
use App\Factory\CircuitGraph;
use App\Factory\CompleteGraph;
use App\Factory\FullBipartiteGraph;
use App\Factory\PathGraph;
use App\Factory\TreeGraph;
use App\Factory\WheelGraph;

class GraphFactory {
    public static function createGraph($type, $n) {
        switch ($type) {
            case 'k':
                return new CompleteGraph($n);
            case 'path':
                return new PathGraph($n);
            case 'circuit':
                return new CircuitGraph($n);
            case 'tree':
                return new TreeGraph($n);
            case 'fullBipartite':
                return new FullBipartiteGraph($n);
            case 'wheel':
                return new WheelGraph($n);
            default:
                throw new InvalidArgumentException("Unknown graph type: $type");
        }
    }
}
?>