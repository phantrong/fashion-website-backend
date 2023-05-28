<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwaggerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $baseFile = fopen('swagger/api.yaml', 'w');
        $data = '';
        foreach (glob("swagger/swaggers/*.yaml") as $filename) {
            if ($filename != 'swagger/api.yaml') {
                $file = fopen($filename, 'r');
                $data = '';
                while (!feof($file)) {
                    $data .= fread($file, 4000);
                }
                fclose($file);
                fwrite($baseFile, $data);
            }
        }

        $data = '';
        $fileHeadComponents = fopen('swagger/components/_head.yaml', 'r');
        while (!feof($fileHeadComponents)) {
            $data .= fread($fileHeadComponents, 4000);
        }
        fwrite($baseFile, $data);
        $this->swaggerComponents($baseFile, 'swagger/components/schemas');
        $this->swaggerComponents($baseFile, 'swagger/components/requestBodies');
        $this->swaggerComponents($baseFile, 'swagger/components/securitySchemes');

        fclose($baseFile);
    }

    public function swaggerComponents($baseFile, $pathFolder)
    {
        foreach (glob("$pathFolder/*.yaml") as $filename) {
            $file = fopen($filename, 'r');
            $data = '';
            while (!feof($file)) {
                $data .= fread($file, 4000);
            }
            fclose($file);
            fwrite($baseFile, $data);
        }
        return;
    }
}
