<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Mail\SendEmail as SendEmailMailable;
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

    /**
     * @return int|void
     */
    public function handle()
    {
        $argument = [
            'email' => $this->argument('email')
        ];

        $rules = [
            'email.*' => ['required','email', new ValidEmail ]
        ];

        $validator = Validator::make($argument, $rules);

        $product = Product::all()->first();

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        if(!is_null($product)){
            Mail::to($this->argument('email'))->queue((new SendEmailMailable($product->name, $product->description))->onQueue('emails'));
            return $this->info('Success');
        }else{
            return $this->info('Product does not exist');
        }
    }
}
