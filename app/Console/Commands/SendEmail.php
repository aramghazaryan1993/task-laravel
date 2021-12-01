<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Mail\SendEmail as SendEmailMailable;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * Class SendEmail
     * @package App\Console\Commands
     */

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

        Mail::to($this->argument('email'))->send(new SendEmailMailable($product->name,$product->description));

        return $this->info('Success');
    }
}
