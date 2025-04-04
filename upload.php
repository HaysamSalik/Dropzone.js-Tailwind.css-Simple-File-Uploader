<?php
// Enable CORS if needed
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Dropzone config
$targetDir = __DIR__ . '/uploads';
$chunkDir = $targetDir . '/chunks';

if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
if (!is_dir($chunkDir)) mkdir($chunkDir, 0777, true);

// Get file info
$filename = $_POST['dzuuid'] ?? uniqid();
$chunkIndex = intval($_POST['dzchunkindex'] ?? 0);
$totalChunks = intval($_POST['dztotalchunkcount'] ?? 1);
$originalName = $_POST['name'] ?? 'upload.zip';

// Handle uploaded chunk
if (isset($_FILES['file']['tmp_name'])) {
    $chunkPath = "$chunkDir/{$filename}_{$chunkIndex}.part";
    move_uploaded_file($_FILES['file']['tmp_name'], $chunkPath);
}

// Assemble chunks if all are uploaded
$allChunksUploaded = true;
for ($i = 0; $i < $totalChunks; $i++) {
    if (!file_exists("$chunkDir/{$filename}_{$i}.part")) {
        $allChunksUploaded = false;
        break;
    }
}

if ($allChunksUploaded) {
    $finalPath = "$targetDir/$originalName";
    $out = fopen($finalPath, "wb");

    for ($i = 0; $i < $totalChunks; $i++) {
        $part = file_get_contents("$chunkDir/{$filename}_{$i}.part");
        fwrite($out, $part);
        unlink("$chunkDir/{$filename}_{$i}.part");
    }

    fclose($out);
    echo json_encode(['status' => 'success', 'message' => 'File uploaded successfully']);
} else {
    echo json_encode(['status' => 'partial', 'message' => 'Chunk uploaded']);
}
