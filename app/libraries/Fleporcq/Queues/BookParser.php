<?php
namespace Fleporcq\Queues;


use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BookParser {
    const EXTENSION = "epub";

    const CONTAINER_FILE_PATH = 'META-INF/container.xml';

    public function fire($job, $data)
    {
        $file = $data["file"];
        if(File::exists($file) && File::extension($file) === self::EXTENSION){
            $zipper = new Zipper();
            $zipper->make($file);
            try {
                $containerFile = $zipper->getFileContent(self::CONTAINER_FILE_PATH);
            } catch (\Exception $e){
                return Log::error($file . " - " . CONTAINER_FILE_PATH . ' not found. ' . $e);
            }
            $container = simplexml_load_string($containerFile);
            $rootFilePath = $container->rootfiles->rootfile['full-path'];
            try {
                $rootFile = $zipper->getFileContent($rootFilePath);
            }
            catch (\Exception $e){
                return Log::error($file . " - " . CONTAINER_FILE_PATH . ' not found. ' . $e);
            }
            $package = simplexml_load_string($rootFile);
            echo $package->metadata->children('dc', true)->title;
            echo $package->metadata->children('dc', true)->creator;

            $job->delete();
        } else {
            return Log::error($file . ' not found. ');
        }
    }
}