<?php

namespace App\Route\API;
use Controller\Route;

class download extends Route{
    public function init(){
        if(!$this->props) return 403;
        if(!isset($this->getData['template_name']) || !$this->getData['template_name']) return false;
        
        switch ($this->method) {
            case 'GET':
                $name = $this->getData['template_name'];

                if(is_dir(THEMES . DIRECTORY_SEPARATOR . $name)){
                    $zip = new \ZipArchive();
                    $zip->open(THEMES . "/$name.zip", \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                    $this->addFileRecursion($zip, THEMES . DIRECTORY_SEPARATOR . $name);
                    $zip->close();

                    header('Content-Description: File Transfer');
                    header('Content-Type: application/zip');
                    header('Content-Disposition: attachment; filename=' . $name);
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize(THEMES . DIRECTORY_SEPARATOR . "$name.zip"));

                    echo file_get_contents(THEMES . DIRECTORY_SEPARATOR . "$name.zip");
                    unlink(THEMES . DIRECTORY_SEPARATOR . "$name.zip");
                    return true;
                }
                break;
        }
        return false;
    }
    private function addFileRecursion($zip, $dir, $start = ''){
        if (empty($start)) {
            $start = $dir;
        }
        if ($objs = glob($dir . '/*')) {
            foreach($objs as $obj) { 
                if (is_dir($obj)) {
                    $this->addFileRecursion($zip, $obj, $start);
                } else {
                    $zip->addFile($obj, str_replace(dirname($start) . '/', '', $obj));
                }
            }
        }
    }
}