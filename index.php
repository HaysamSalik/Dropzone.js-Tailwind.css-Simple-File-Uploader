<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIP File Uploader</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <style>
        .dropzone {
            border: 3px dashed #4b5563;
            border-radius: 0.75rem;
            background: #f3f4f6;
            min-height: 300px;
            padding: 20px;
        }

        .dropzone .dz-message {
            font-size: 1.5rem;
            color: #6b7280;
            margin: 3em 0;
        }

        .dropzone .dz-preview.dz-image-preview {
            background: transparent;
        }

        .progress-container {
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 5px;
            margin-top: 10px;
        }

        .progress-bar {
            height: 20px;
            border-radius: 5px;
            background-color: #3b82f6;
            width: 0%;
            transition: width 0.3s;
            text-align: center;
            line-height: 20px;
            color: white;
        }

        .upload-complete {
            background-color: #10b981 !important;
        }

        .upload-error {
            background-color: #ef4444 !important;
        }

        .file-info {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1rem;
        }

        .file-icon {
            font-size: 3rem;
            color: #3b82f6;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">ZIP File Uploader</h1>
            <p class="text-lg text-gray-600">Upload large ZIP files with chunked transfers for reliable delivery</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-800">Upload Your ZIP File</h2>
            </div>

            <form action="upload.php" class="dropzone" id="zip-dropzone">
                <div class="dz-message">
                    <div class="flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <span class="block">Drag & drop your ZIP file here or click to browse</span>
                        <span class="block text-sm text-gray-500 mt-1">(Only .zip files accepted)</span>
                    </div>
                </div>
            </form>

            <div id="upload-progress" class="hidden mt-6">
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-700">Upload Progress</span>
                    <span id="progress-percent" class="font-medium text-gray-700">0%</span>
                </div>
                <div class="progress-container">
                    <div id="progress-bar" class="progress-bar">0%</div>
                </div>
                <div id="file-details" class="file-info hidden">
                    <div class="flex items-center">
                        <div class="file-icon mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 id="file-name" class="font-medium text-lg"></h3>
                            <p id="file-size" class="text-gray-600"></p>
                            <p id="file-status" class="text-sm mt-1"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800">Chunked Uploads</h3>
                    </div>
                    <p class="text-gray-600">Large files are split into smaller chunks for reliable transfer, even with unstable connections.</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800">ZIP Files Only</h3>
                    </div>
                    <p class="text-gray-600">We only accept ZIP files to ensure proper compression and organization of your data.</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800">Secure Transfer</h3>
                    </div>
                    <p class="text-gray-600">Files are transferred securely and reassembled on our server to their original form.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        Dropzone.options.zipDropzone = {
            maxFilesize: 10240, // 10GB
            maxFiles: 1,
            acceptedFiles: ".zip",
            chunking: true,
            forceChunking: true,
            chunkSize: 1024 * 1024, // 1MB
            parallelChunkUploads: false,
            retryChunks: true,
            retryChunksLimit: 3,
            init: function() {
                this.on("uploadprogress", function(file, progress) {
                    document.getElementById("upload-progress").classList.remove("hidden");
                    const bar = document.getElementById("progress-bar");
                    const percent = document.getElementById("progress-percent");

                    bar.style.width = progress + "%";
                    bar.textContent = Math.floor(progress) + "%";

                    if (progress === 100) {
                        bar.classList.add("upload-complete");
                        document.getElementById("file-status").textContent = "Upload complete.";
                    }
                });

                this.on("success", function(file, response) {
                    document.getElementById("file-details").classList.remove("hidden");
                    document.getElementById("file-name").textContent = file.name;
                    document.getElementById("file-size").textContent = (file.size / (1024 * 1024)).toFixed(2) + " MB";
                });

                this.on("error", function(file, message) {
                    document.getElementById("progress-bar").classList.add("upload-error");
                    document.getElementById("file-status").textContent = "Upload failed: " + message;
                });
            }
        };
    </script>
</body>

</html>