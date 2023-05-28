<?php

namespace App\Jobs;

use App\Enum\LogEnum;
use App\Enum\VerifyEnum;
use App\Mail\MailVerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailVerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $data;
    public $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, array $data)
    {
        $this->email = $email;
        $this->data = $data;
        $this->type = $data['type'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        log_send_email($this->email, LogEnum::LOG_EMAIL_VERIFY, $this->data);

        if ($this->type === VerifyEnum::TYPE_REGISTER_SETTING_PWD) {
            Mail::to($this->email)->send(new MailVerifyEmail($this->data));
        }

        if ($this->type === VerifyEnum::TYPE_CHANGE_PWD) {
            //
        }
    }
}
