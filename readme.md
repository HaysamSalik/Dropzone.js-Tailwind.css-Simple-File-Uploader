# 📁 ZIP File Uploader

A modern web-based ZIP file uploader with chunked upload support, built using **Dropzone.js** and **Tailwind CSS**. Designed to handle large file uploads reliably with a beautiful and responsive interface.

## ✨ Features

- ✅ Drag & Drop interface
- ✅ Chunked file uploads for large ZIP files
- ✅ Real-time upload progress with a dynamic progress bar
- ✅ Responsive design with Tailwind CSS
- ✅ Restricts uploads to `.zip` files only
- ✅ Detailed file preview and status display

## 🚀 Getting Started

### Requirements

- PHP 7.x or higher
- Web server (e.g., Apache or Nginx)
- Composer (optional, for managing dependencies if you expand the project)

### Folder Structure

```
project-root/
├── index.php          # Main front-end UI
├── upload.php          # Handles file uploads
├── uploads/            # Destination for uploaded files
├── README.md           # This file
```

### 1. Clone the Repository

```bash
git clone https://github.com/HaysamSalik/zip-file-uploader.git
cd zip-file-uploader
```

### 2. Set Up Upload Directory

Make sure the `uploads/` folder exists and is writable:

```bash
mkdir uploads
chmod 777 uploads
```

### 3. Run the App

Open `index.php` in your browser or serve it via a local server:

```bash
php -S localhost:8000
```

Then go to: [http://localhost:8000/index.php](http://localhost:8000/index.php)

### 4. Upload a File

- Drag and drop a `.zip` file or click the dropzone to select a file.
- Watch the upload progress bar update in real-time.
- Upon successful upload, file details are displayed below the progress bar.

## ⚙️ Customization

- Modify `upload.php` for handling files, chunked uploads, file validations, etc.
- Style updates can be done in the `<style>` section or through Tailwind utility classes.
- For advanced handling (chunk saving, file reconstruction, virus scanning), you can integrate a backend framework.

## 📦 Dependencies

- [Dropzone.js](https://www.dropzone.dev/)
- [Tailwind CSS](https://tailwindcss.com/)

## 🛡️ Security Tips

- Sanitize uploaded files.
- Validate MIME types and file size.
- Implement authentication/authorization if used in production.

## 🧑‍💻 Author

Developed by [Haysam Salik](https://github.com/HaysamSalik)

## 📄 License

MIT License. See [LICENSE](LICENSE) for details.
