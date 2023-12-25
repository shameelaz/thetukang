<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use Illuminate\Support\Facades\Storage;
use Workbench\Database\Model\Payment\PenyataPemungutMain;
use Workbench\Database\Model\Payment\PenyataPemungutDetail;
use Workbench\Database\Model\Payment\ResitPerbendaharaanLog;
use DateTime;

class Resit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ispeks:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get resit from Ispeks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
   /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $files = Storage::disk('pp_in')->files();
        // dd($files);
        
        foreach ($files as $key =>$file)
        {
            $target = $file;

            $filename=storage_path('app\pp_in')."\\".$target;
            $newfile=storage_path('app\archive')."\\".$target;
            $content = File::get($filename);
            $array = preg_split("/\r\n|\n|\r/", $content);

            $header = '';

            // dd($array);

            foreach ($array as $key2 => $lines)
            {

                if($key2 > 0)
                {
                    if(isset($data[0]))
                    {
                        $data = explode('|', $lines);

                        $resitno = $data[3];
                        $nopp    = $data[5];
                        $tarikh  = $data[4];

                        //convert dat string to realdate : 
                        $ymd = DateTime::createFromFormat('dmY', $tarikh)->format('Y-m-d');

                        $checktable = PenyataPemungutMain::where('no_penyata_pemungut','=',$nopp)->first();
                        if($checktable)
                        {
                            $checktable->status = 7;
                            $checktable->resit_perbendaharaan = $resitno;
                            $checktable->tarikh_perbendaharaan = $ymd;
                            $checktable->update();
                        }

                    }
                }
                else
                {
                    $header = $lines;
                }

            }

            //insert logs tabl
            $logs = new ResitPerbendaharaanLog;
            $logs->file_name = $target;
            $logs->header = $header;
            $logs->body = $content;
            $logs->save();

            // dd($newfile);

            //delete or transfer file to archive
            echo ($filename);
            echo ("\n");
            echo ($newfile.'.bak');
            echo ("\n");

            File::move($filename, $newfile.'.bak');

        }



    }
}
