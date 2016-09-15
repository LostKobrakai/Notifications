<?php namespace LostKobrakai;

use ProcessWire\WireData;

class Notification extends WireData
{

	const DELIMITER = '<?>';

	/**
	 * @var string
	 */
	private $message;
	/**
	 * @var string
	 */
	private $color;

	/**
	 * Notification constructor.
	 *
	 * @param        $message
	 * @param string $color
	 */
	public function __construct ($message, $color = 'green')
	{
		$this->message = $message;
		$this->color = $color;
	}

	/**
	 * @return string
	 */
	public function getMessage ()
	{
		return $this->message;
	}

	/**
	 * @return string
	 */
	public function getColor ()
	{
		return $this->color;
	}

	/**
	 * Add to global notifications array
	 *
	 * @param string $message
	 * @param string $color
	 */
	public static function add ($message, $color = 'green')
	{
		\ProcessWire\wire('notifications')->add(new static($message, $color));
	}

	/**
	 * @param string $string
	 * @return static
	 */
	public static function fromString ($string)
	{
		list($message, $color) = explode(self::DELIMITER, $string, 2);
		return new static($message, $color);
	}

	public function __toString ()
	{
		return $this->message . self::DELIMITER . $this->color;
	}

}