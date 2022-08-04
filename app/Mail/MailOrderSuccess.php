<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class MailOrderSuccess extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
public function build(Request $request)
    {     
        return $this->from('mail@example.com', 'Turmalina')
            ->subject('Papelaria Turmalina')
            ->markdown('mails.order_success')->with(['pedido' => $request->order_id, 'order' => $this->parameter]);
    }
}