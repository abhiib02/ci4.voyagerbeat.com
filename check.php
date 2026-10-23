<?php
$files = [__DIR__ . '/index.php'];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/app'));
foreach ($it as $f) {
    if ($f->isFile() && $f->getExtension() === 'php') $files[] = $f->getPathname();
}

foreach ($files as $file) {
    $c = file_get_contents($file);
    $problems = [];

    if (str_starts_with($c, "\xEF\xBB\xBF")) {
        $problems[] = 'BOM at start';
    } elseif (!str_starts_with($c, '<?php')) {
        $problems[] = 'starts with: ' . json_encode(substr($c, 0, 10));
    }

    // text after the LAST closing tag (a single trailing newline is harmless)
    $pos = strrpos($c, '?>');
    if ($pos !== false) {
        $after = substr($c, $pos + 2);
        if (preg_match('/^(\r?\n)?.+/s', $after)) {
            $problems[] = 'content after ?> : ' . json_encode($after);
        }
    }

    if ($problems) {
        echo '<b>' . str_replace(__DIR__, '', $file) . '</b>: ' . implode(', ', $problems) . '<br>';
    }
}
echo 'done';
