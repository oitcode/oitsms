<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SmsSend extends Component
{
    public $phone;
    public $message;

    public function render()
    {
        return view('livewire.sms-send');
    }

    public function sendSms()
    {
        $validatedData = $this->validate([
            'phone' => 'required',
            'message' => 'required',
        ]);

        $args = http_build_query(array(
            'token' => 'foobar',
            'from'  => 'InfoSMS',
            'to'    => $this->phone,
            'text'  => $this->message));

        $url = "http://api.sparrowsms.com/v2/sms/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->phone = '';
        $this->message = '';
    }
}
