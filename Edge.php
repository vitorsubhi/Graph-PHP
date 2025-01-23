<?php
    class Edge {
        private Vertex $source;
        private Vertex $target;

        public function __construct(Vertex $source, Vertex $target) {
            $this->source = $source;
            $this->target = $target;
        }

        public function getVertices() {
            return [$this->source, $this->target];
        }

        public function getVerticesIds() {
            return [$this->source->getId(), $this->target->getId()];
        }

        public function setVertices(Vertex $source, Vertex $target) {
            $this->source = $source;
            $this->target = $target;
        }

        public function contains(Vertex $vertex) {
	        return $this->source === $vertex || $this->target === $vertex;
	    }

        public function show() {
	        return "{".$this->source->getID().", ".$this->target->getId()."}";
	    }
    }
?>
