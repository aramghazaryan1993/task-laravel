<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Mail\SendEmail as SendEmailMailable;
use Illuminate\Support\Facades\Mail;

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

       if($product !== null){
           Mail::to($this->argument('email'))->send(new SendEmailMailable($product->name, $product->description));
                    return $this->info('Success');
       }else{
           return $this->info('Product does not exist');
       }

    }
}
