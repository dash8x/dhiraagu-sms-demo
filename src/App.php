<?php

namespace Dash8x\DhiraaguSmsDemo;


use Dash8x\DhiraaguSms\DhiraaguSms;
use Dash8x\DhiraaguSms\Exception\DhiraaguDeliveryException;
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
     * The phone numbers
     * @var array
     */
    public $numbers;

    /**
     * The message id
     * @var string
     */
    public $message_id;

    /**
     * The message key
     * @var string
     */
    public $message_key;

    /**
     * Alerts
     * @var array
     */
    public $alerts = [];

    /**
     * The current tab
     * @var string
     */
    public $tab = 'sms';

    /**
     * The sms sender
     * @var DhiraaguSms
     */
    public $sender = 'sms';

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

        $this->message_id = $params['message_id'] ?? '';
        $this->message_key = $params['message_key'] ?? '';

        $numbers = explode(',', $params['numbers'] ?? '');
        $this->numbers = $numbers;

        $this->sender = new DhiraaguSms($this->username, $this->password, $this->url);

        $action = $params['submit'] ?? '';
        $this->process($action);
    }

    /**
     * Escape html
     *
     * @param string
     * @return string
     */
    public function escapeHtml($string)
    {
        return htmlspecialchars($string);
    }

    /**
     * Get escaped value of a field
     *
     * @param $field
     * @return string
     */
    public function escaped($field)
    {
        return $this->escapeHtml($this->{$field});
    }

    /**
     * Process the request
     * @param string
     */
    protected function process($action)
    {
        switch ($action) {
            case 'send_sms':
                $this->tab = 'sms';
                $this->sendSms();
                break;

            case 'check_delivery':
                $this->tab = 'delivery';
                $this->checkDelivery();
                break;
        }
    }

    /**
     * Send sms
     */
    protected function sendSms()
    {
        $sender = $this->sender;

        $numbers = $this->numbers;
        foreach ($numbers as $i => $number) {
            $numbers[$i] = '+960'.trim($number);
        }

        try {
            $response = $sender->send($numbers, $this->message);
            $this->message_id = $response['message_id'];
            $this->message_key = $response['message_key'];

            $this->alerts[] = [
                'type' => 'success',
                'text' => "Message sent!\n".json_encode($response),
            ];
        } catch (DhiraaguSmsException $e) {
            $this->alerts[] = [
                'type' => 'danger',
                'text' => 'Error! '.$e->getMessage(),
            ];
        }
    }

    /**
     * Check delivery status
     */
    protected function checkDelivery()
    {
        $sender = $this->sender;

        try {
            $response = $sender->delivery($this->message_id, $this->message_key);

            $this->alerts[] = [
                'type' => 'success',
                'text' => "Delivery status\n".json_encode($response),
            ];
        } catch (DhiraaguDeliveryException $e) {
            $this->alerts[] = [
                'type' => 'danger',
                'text' => 'Error! '.$e->getMessage(),
            ];
        }
    }
}