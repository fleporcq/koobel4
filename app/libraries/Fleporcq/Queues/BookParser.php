<?php
namespace Fleporcq\Queues;


use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Nathanmac\Utilities\Parser\Parser;

class BookParser {
    const EXTENSION = "epub";

    const CONTAINER_FILE_PATH = 'META-INF/container.xml';

    public function fire($job, $data)
    {
        $file = $data["file"];
        if(File::exists($file) && File::extension($file) === self::EXTENSION){
            $zipper = new Zipper();
            $zipper->make($file);
            $containerFile = $zipper->getFileContent(self::CONTAINER_FILE_PATH);

            $parser = new Parser();
            $containerFileParsed = $parser->xml($containerFile);
            $rootFilePath = $containerFileParsed["rootfiles"]["rootfile"]["@attributes"]["full-path"];
            $rootFile = $zipper->getFileContent($rootFilePath);
            $rootFileParsed = $parser->xml($rootFile);
            $creator = $parser->get('dc:creator');
            echo $creator;
            echo $rootFile;
        }
        $job->delete();
    }
}