<?php
    require __DIR__ . '/vendor/autoload.php';
    use App\GraphFactory as GraphFactory;

    $graphType = $_GET['type'] ?? 'k';
    $numVertices = (int) ($_GET['vertices'] ?? 7);

    try {
        $graph = GraphFactory::createGraph($graphType, $numVertices);
        $data = $graph->d3();
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
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
            <select name="type" id="type">
                <option value="k" <?= $graphType === 'k' ? 'selected' : '' ?>>Complete Graph (K<sub>n</sub>)</option>
                <option value="path" <?= $graphType === 'path' ? 'selected' : '' ?>>Path</option>
                <option value="circuit" <?= $graphType === 'circuit' ? 'selected' : '' ?>>Circuit</option>
                <option value="tree" <?= $graphType === 'tree' ? 'selected' : '' ?>>Tree</option>
                <option value="fullBipartite" <?= $graphType === 'fullBipartite' ? 'selected' : '' ?>>Full Bipartite</option>
                <option value="wheel" <?= $graphType === 'wheel' ? 'selected' : '' ?>>Wheel</option>
            </select>

            <label for="vertices">Number of Vertices:</label>
            <input type="number" name="vertices" id="vertices" min="1" value="<?= $numVertices ?>">

            <button type="submit">Generate Graph</button>
        </form>

        <div class="graph-name"><?php echo $graph->getName(); ?></div>
        <svg width="600" height="600"></svg>
        <script>
            const nodes = <?php echo $data['nodes']; ?>;
            const links = <?php echo $data['links']; ?>;
        </script>
       
        <script src="assets/script.js"></script>
    </body>
</html>
