<?php
    require __DIR__ . '/vendor/autoload.php';
    use App\GraphFactory as GraphFactory;

    $graphType = $_GET['type'] ?? 'k';
    $numVertices = (int) ($_GET['vertices'] ?? 7);
    $numPartitions = (int) ($_GET['partitions'] ?? 2);

    $graph = null;
    $error = "Internal Server Error";
    try {
        $graph = GraphFactory::createGraph($graphType, $numVertices, $numPartitions);
        $data = $graph->draw();
    } catch (Exception $e) {
        $error = "Error: ". $e->getMessage();
    }
?>

<html>
    <head>
        <title>Graph Visualization</title>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>

        <form method="GET" action="">
            <label for="type">Select Graph Type:</label>
            <select name="type" id="type" onchange="togglePartitions()">
                <option value="circuit" <?= $graphType === 'circuit' ? 'selected' : '' ?>>Circuit</option>
                <option value="complete" <?= $graphType === 'complete' ? 'selected' : '' ?>>Complete Graph (K<sub>n</sub>)</option>
                <option value="fullBipartite" <?= $graphType === 'fullBipartite' ? 'selected' : '' ?>>Full Bipartite</option>
                <option value="kPartite" <?= $graphType === 'kPartite' ? 'selected' : '' ?>>K Partite</option>
                <option value="path" <?= $graphType === 'path' ? 'selected' : '' ?>>Path</option>
                <option value="tree" <?= $graphType === 'tree' ? 'selected' : '' ?>>Tree</option>
                <option value="wheel" <?= $graphType === 'wheel' ? 'selected' : '' ?>>Wheel</option>
            </select>

            <label for="vertices">Number of Vertices:</label>
            <input type="number" name="vertices" id="vertices" min="1" value="<?= $numVertices ?>">

            <div id="partitions-section" style="display: <?= $graphType === 'kPartite' ? 'block' : 'none' ?>;">
                <label for="partitions">Number of Partitions:</label>
                <input type="number" name="partitions" id="partitions" min="2" value="<?= $numPartitions ?>">
            </div>

            <button type="submit">Generate Graph</button>
        </form>

        <div class="graph-name"><?php echo $graph ? $graph->getName() : $error; ?></div>
        <svg width="600" height="600"></svg>
        <script>
            const nodes = <?php echo $data['nodes']; ?>;
            const links = <?php echo $data['links']; ?>;

            function togglePartitions() {
                const graphType = document.getElementById("type").value;
                const partitionsSection = document.getElementById("partitions-section");
                if (graphType === "kPartite") {
                    partitionsSection.style.display = "block";
                } else {
                    partitionsSection.style.display = "none";
                }
            }
        </script>
       
        <script src="assets/script.js"></script>
    </body>
</html>
