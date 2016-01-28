<?php



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
