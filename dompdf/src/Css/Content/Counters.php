<?php
<<<<<<< HEAD

=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
namespace Dompdf\Css\Content;

final class Counters extends ContentPart
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $string;

    /**
     * @var string
     */
    public $style;

    public function __construct(string $name, string $string, string $style)
    {
        $this->name = $name;
        $this->string = $string;
        $this->style = $style;
    }

    public function equals(ContentPart $other): bool
    {
        return $other instanceof self
            && $other->name === $this->name
            && $other->string === $this->string
            && $other->style === $this->style;
    }

    public function __toString(): string
    {
<<<<<<< HEAD
        return "counters($this->name, '{$this->string}', $this->style)";
=======
        return "counters($this->name, \"$this->string\", $this->style)";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    }
}
