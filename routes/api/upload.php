<?php

namespace App\Route\API;
use Controller\Route;

class upload extends Route{
    public function init(){
        switch ($this->method) {
            case 'GET':
                $templates = array_slice(scandir(THEMES), 2);
                if($templates) {
                    print(json_encode($templates));
                    return true;
                }
                break;
            case 'POST':
                if (!isset($this->getData['template_name']) || !$this->getData['template_name']) return;
                if (is_dir(THEMES . DIRECTORY_SEPARATOR . $this->getData['template_name'])) {
                    return 409;
                }
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['file']['tmp_name'];
                    $fileName = $_FILES['file']['name'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
                    $allowedfileExtensions = ['zip'];
                    if (in_array($fileExtension, $allowedfileExtensions)) {
                        $themeFolder = THEMES . DIRECTORY_SEPARATOR . clearVal($this->getData['template_name']);
                        mkdir($themeFolder);
                        $zip = new \ZipArchive;
                        $res = $zip->open($fileTmpPath);
                        if ($res == TRUE) {
                            $zip->extractTo($themeFolder);
                            $zip->close();
                            return 200;
                        } else {
                            return 406;
                        }
                    } else {
                        echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                        return 415;
                    }
                }
                break;
            case 'DELETE':
                if (!isset($this->getData['template_name']) || !$this->getData['template_name']) break;
                if (is_dir(THEMES . DIRECTORY_SEPARATOR . clearVal($this->getData['template_name']))) {
                    $this->recursiveRemoveDir(THEMES . DIRECTORY_SEPARATOR . clearVal($this->getData['template_name']));
                    return true;
                }
                break;
        }
        return false;
    }
    private function recursiveRemoveDir($dir) {
        $includes = new \FilesystemIterator($dir);
        foreach ($includes as $include) {
            if(is_dir($include) && !is_link($include)) {
                self::recursiveRemoveDir($include);
            }
            else {
                unlink($include);
            }
        }
        rmdir($dir);
    }
}
