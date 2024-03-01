<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Emails;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class Contact extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $resp;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Emails $email, $resp)
    {
        $this->email = $email;
        $this->resp = $resp;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@example.com', 'Support')
                    ->subject($this->email->subject)
                    ->view('auth.email');
    }
}
