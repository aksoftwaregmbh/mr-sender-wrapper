<?php


namespace AKSoftware\MrSenderWrapper;

use AKSoftware\MrSenderWrapper\Helpers\CommonHelper;

class Fax
{
    private $_username = null;
    private $_password = null;
    public $server = "https://www.mr-sender.com/api/";
    public $commonHelper;

    /**
     * Fax constructor.
     * @param $_username
     * @param $_password
     */
    public function __construct($_username, $_password)
    {
        // save username
        $this->_username = $_username;
        // save password
        $this->_password = $_password;
        $this->commonHelper = new CommonHelper($this->_username, $this->_password, $this->server);
    }

    /**
     * @param $message
     * @param string $recipient
     * @return string
     * @throws Exception
     */
    public function sendHtmlFax($message, $recipient)
    {
        // set message option
        $this->commonHelper->setOption("content", $message);
        // se the recipients into the options list
        $this->commonHelper->setOption("to", $recipient);
        // start request width defined options for this action
        $response = $this->commonHelper->request("fax/send", $this->commonHelper->getOptions([
            "to",
            "content",
        ]));

        return $this->commonHelper->setStatus($response);
    }

    /**
     * @return mixed
     */
    public function getStatusMessage()
    {
        return $this->commonHelper->statusMessage;
    }
}
