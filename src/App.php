<?php

namespace Dash8x\DhiraaguSmsDemo;


use Dash8x\DhiraaguSms\DhiraaguSms;
use Dash8x\DhiraaguSms\Exception\DhiraaguSmsException;

class App
{
    /**
     * The bulk sms username
     * @var string
     */
    public $username;

    /**
     * The bulk sms password
     * @var string
     */
    public $password;

    /**
     * The bulk sms API url
     * @var string
     */
    public $url;

    /**
     * The sms message
     * @var string
     */
    public $message;

    /**
     * The phone number
     * @var string
     */
    public $number;

    /**
     * Alerts
     * @var array
     */
    public $alerts = [];

    /**
     * App constructor
     * @param array $params
     */
    public function __construct($params)
    {
        $this->username = $params['username'] ?? '';
        $this->password = $params['password'] ?? '';
        $this->url = $params['url'] ?? DhiraaguSms::DEFAULT_API_URL;
        $this->message = $params['message'] ?? '';
        $this->number = $params['number'] ?? '';

        if (! empty($params['submit'])) {
            $this->process();
        }
    }

    /**
     * Process the request
     */
    protected function process()
    {
        $sender = new DhiraaguSms($this->username, $this->password, $this->url);

        try {
            $sender->send('+960' . $this->number, $this->message);

            $this->alerts[] = [
                'type' => 'success',
                'text' => 'Message sent!',
            ];
        } catch (DhiraaguSmsException $e) {
            $this->alerts[] = [
                'type' => 'danger',
                'text' => 'Error! '.$e->getMessage(),
            ];
        }
    }
}