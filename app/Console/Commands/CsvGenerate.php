<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\File;

class CsvGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a CSV file with the information from the expected XML file and the endpoint https://jsonplaceholder.typicode.com/users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $t1 = microtime(1);
        $thereIsXml = FALSE;
        if (sizeof(Storage::files('XmlFiles')) > 0) {

            $xml = simplexml_load_string(File::get(storage_path('app/' . Storage::files('XmlFiles')[0])));

            $dataXml = [];
            foreach ($xml->children() as $childName => $child) {
                $dataXml[$child->__toString()] = [];
                foreach ($child->attributes() as $key => $value) {
                    $dataXml[$child->__toString()][$key] = $value->__toString();
                }
            }

            $thereIsXml = TRUE;
            Storage::delete(Storage::files('XmlFiles'));
        }

        $url = 'https://jsonplaceholder.typicode.com/users';
        $thereIsUrl = FALSE;
        $dataUrl = json_decode(file_get_contents($url), TRUE);
        if (sizeof($dataUrl) > 0) $thereIsUrl = TRUE;
        $threIsData = FALSE;
        $dataCsv = [];
        if ($thereIsXml) {
            $threIsData = TRUE;
            foreach ($dataXml as $email => $data) {
                $entry = [];
                $entry['name'] = $data['name'];
                $entry['email'] = $email;
                $entry['phone'] = $data['phone'];
                $entry['companyName'] = $data['company'];
                array_push($dataCsv, $entry);
            }
            $qty = sizeof($dataXml);
            $this->line("There where {$qty} contacts in the XML file");
        } else {
            $this->line("There was not a XML file");
        }
        if ($thereIsUrl) {
            $threIsData = TRUE;
            foreach ($dataUrl as $data) {
                $entry = [];
                $entry['name'] = $data['name'];
                $entry['email'] = $data['email'];
                $entry['phone'] = $data['phone'];
                $entry['companyName'] = $data['company']['name'];
                array_push($dataCsv, $entry);
            }
            $qty = sizeof($dataUrl);
            $this->line("There where $qty contacts in the url {$url}");
        } else {
            $this->line("There was not data in the url {$url}");
        }

        $date = date('Y-m-d_H-i-s', time(NOW()));
        $file = "output_data_{$date}.csv";
        $pathToFile = storage_path('app\\outputCsv\\' . $file);
        Storage::makeDirectory('outputCsv');

        file_put_contents($pathToFile, '');
        file_put_contents($pathToFile, 'Nombre,Email,Telefono,Empresa' . PHP_EOL, FILE_APPEND | LOCK_EX);

        if ($threIsData) {
            foreach ($dataCsv as $entry) {
                file_put_contents($pathToFile, "{$entry['name']},{$entry['email']},{$entry['phone']},{$entry['companyName']}" . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        }

        $qty = sizeof($dataCsv);
        $this->line("Successfully Generated the file {$file} with {$qty} contacts");

        echo 'Elapsed ' . (microtime(1) - $t1) . ' seconds';
    }
}
