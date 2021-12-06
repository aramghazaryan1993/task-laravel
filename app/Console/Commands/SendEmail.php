<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Mail\SendProductInfoToUserByEmail;
use Illuminate\Support\Facades\Mail;
use App\Rules\ValidEmail;
use Illuminate\Support\Facades\Validator;
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
        $argument = [
            'emails' => $this->argument('email')
        ];

        $rules = [
            'emails' => new ValidEmail($this->argument('email'))
        ];

        $validator = Validator::make($argument, $rules);

        $product   = Product::all()->first();

        if($validator->passes())
        {
            if(!is_null($product)){
                Mail::to($this->argument('email'))->queue((new SendProductInfoToUserByEmail($product->name, $product->description))->onQueue('emails'));
                return $this->info('Success');
            }else{
                return $this->info('Product does not exist');
            }
        }else{
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
        }
    }
}
