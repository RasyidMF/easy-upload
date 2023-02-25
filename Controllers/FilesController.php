<?php

namespace Controllers;

use Utils\Config;
use Utils\Controller;
use Utils\Glob;
use Utils\Logger;
use Utils\Request;
use Utils\Response;
use Utils\Uploader;

class FilesController extends Controller
{
    public function getFile() {
        return Response::json([
            'status' => true,
            'data' => Glob::getDetail(Config::getUploaderPath())
        ]);
    }

    public function uploadFile(Request $request) {
        $this->required(['file', 'parent_folder']);

        $parentFolder = Config::getUploaderPath() . $request->post('parent_folder');
        if (!Uploader::isDirExists($parentFolder)) {
            Uploader::createDirectory($parentFolder);
        }

        
        $file = $request->files('file');
        $identify = Uploader::identify($file);

        if (Uploader::save($file, $parentFolder . "/" . $identify['filename'])) {
            Logger::upload($file, $parentFolder);
            return Response::json([
                'status' => true,
                'message' => 'File successfully uploaded!'
            ]);
        } else {
            return Response::json([
                'status' => false,
                'message' => 'File was fail while uploading!'
            ]);
        }
    }
}