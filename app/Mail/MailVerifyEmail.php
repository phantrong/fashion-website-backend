<?php

namespace App\Mail;

use App\Enum\CommonEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->link = $data['link'];
        $this->user = $data['user'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        if ($this->user->user_role == CommonEnum::USER_ROLE_USER) {
            $subject = '【ThuePhongTro TTH】Thông báo xác nhận đăng ký';
        } else {
            $subject = '【ThuePhongTro TTH】Thông báo cài đặt mật khẩu';
        }

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        if ($this->user->user_role == CommonEnum::USER_ROLE_ADMIN) {
            $template = 'emails.admin_verify_email';
        } else {
            $template = 'emails.user_verify_email';
            $userName = $this->user->first_name . ' ' . $this->user->last_name;
        }

        return new Content(
            view: $template,
            with: [
                'userName' => $userName,
                'link' => $this->link
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
