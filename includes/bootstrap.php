<?php

require_once __DIR__ . '/../vendor/autoload.php';

call_user_func(function () {
    $httpRequest = (new \Nette\Http\RequestFactory())->createHttpRequest();
    preg_match('~^(?:.*\.)?(?P<domain>\w+\.\w+)$~', $httpRequest->getUrl()->getHost(), $host);

    ini_set('session.save_path', __DIR__ . '/../sessions');
    session_set_cookie_params(60 * 60 * 24 * 14, '/', '.' . $host['domain']);
});



class InfiniteArray implements ArrayAccess
{

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var array
     */
    private $override;



    public function __construct($value, array $override = [])
    {
        $this->value = $value;
        $this->override = $override;
    }



    public function offsetExists($offset)
    {
        return true;
    }



    public function offsetGet($offset)
    {
        return array_key_exists($offset, $this->override) ? $this->override[$offset] : $this->value;
    }



    public function offsetSet($offset, $value)
    {
        $this->override[$offset] = $value;
    }



    public function offsetUnset($offset)
    {
        unset($this->override[$offset]);
    }

}
