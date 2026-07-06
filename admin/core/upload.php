<?php
// admin/core/upload.php

class Upload {
    private $target_directory;
    private $allowed_extensions;
    private $max_file_size; // bytes
    private $errors = [];
    private $uploaded_file_path;

    public function __construct($target_directory, $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'], $max_file_size = 5242880) { // 5MB varsayılan
        $this->target_directory = $target_directory;
        $this->allowed_extensions = $allowed_extensions;
        $this->max_file_size = $max_file_size;

        if (!is_dir($this->target_directory)) {
            mkdir($this->target_directory, 0777, true); // Dizin yoksa oluştur
        }
    }

    public function uploadFile($file_input_name) {
        if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = "Dosya yükleme hatası veya dosya seçilmedi.";
            return false;
        }

        $file = $_FILES[$file_input_name];
        $file_name = basename($file['name']);
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Uzantı kontrolü
        if (!in_array($file_ext, $this->allowed_extensions)) {
            $this->errors[] = "Yalnızca " . implode(', ', $this->allowed_extensions) . " uzantılı dosyalar yüklenebilir.";
        }

        // Boyut kontrolü
        if ($file_size > $this->max_file_size) {
            $this->errors[] = "Dosya boyutu " . ($this->max_file_size / 1024 / 1024) . " MB'tan büyük olamaz.";
        }

        // Hata yoksa yükle
        if (empty($this->errors)) {
            $new_file_name = uniqid() . '.' . $file_ext;
            $upload_path = $this->target_directory . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $this->uploaded_file_path = $upload_path;
                return true;
            } else {
                $this->errors[] = "Dosya taşınırken bir hata oluştu.";
            }
        }
        return false;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getUploadedFilePath() {
        return $this->uploaded_file_path;
    }
}
?>