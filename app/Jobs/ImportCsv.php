<?php

namespace App\Jobs;

use App\Models\Record;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $header;
    public $key;
    public $chunkData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($header, $key, $chunkData)
    {
        $this->header = $header;
        $this->key = $key;
        $this->chunkData = $chunkData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $dataArr = [];
        // foreach ($this->chunkData as $data) {
        //     $dataArr[] = array_combine($this->header, $data);
        //     Record::insert($dataArr);
        // }

        foreach ($this->chunkData as $data) {
            $arr = array_combine($this->header, $data);
            Record::create($arr);
        }

    }
}
