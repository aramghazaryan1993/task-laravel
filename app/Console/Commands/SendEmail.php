<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Mail\SendEmail as SendEmailMailable;
use Illuminate\Support\Facades\Mail;
//use App\Jobs\SendEmailJob;

/**
 * Class SendEmail
 * @package App\Console\Commands
 */
class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email {email*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email my product';

    public function handle()
    {
        $product = Product::all()->first();

//       if(!is_null($product)){
//           Mail::to($this->argument('email'))->send(new SendEmailMailable($product->name, $product->description));
//           return $this->info('Success');
//       }else{
//           return $this->info('Product does not exist');
//       }

//       if(!is_null($product)){
//            dispatch(new SendEmailJob($product->name, $product->description,$this->argument('email')));
//           return $this->info('Success');
//       }else{
//           return $this->info('Product does not exist');
//       }


        if(!is_null($product)){
            Mail::to($this->argument('email'))->queue((new SendEmailMailable($product->name, $product->description))->onQueue('emails')->delay(5));
            return $this->info('Success');
        }else{
            return $this->info('Product does not exist');
        }
    }
}
