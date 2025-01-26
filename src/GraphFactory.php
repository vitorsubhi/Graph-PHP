<?php
namespace App;
use App\Factory\CircuitGraph;
use App\Factory\CompleteGraph;
use App\Factory\FullBipartiteGraph;
use App\Factory\KPartiteGraph;
use App\Factory\PathGraph;
use App\Factory\TreeGraph;
use App\Factory\WheelGraph;
use InvalidArgumentException;

class GraphFactory {
    public static function createGraph($type, $nodes, $partitions) {
        switch ($type) {
            case 'circuit':
                return new CircuitGraph($nodes);
            case 'complete':
                return new CompleteGraph($nodes);
            case 'fullBipartite':
                return new FullBipartiteGraph($nodes);
            case 'kPartite':
                return new KPartiteGraph($nodes, $partitions);
            case 'path':
                return new PathGraph($nodes);
            case 'tree':
                return new TreeGraph($nodes);
            case 'wheel':
                return new WheelGraph($nodes);
            default:
                throw new InvalidArgumentException("Unknown graph type: $type");
        }
    }
}
?>
