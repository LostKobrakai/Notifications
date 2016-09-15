<?php namespace LostKobrakai;

use ProcessWire\WireArray;

class Notifications extends WireArray
{
	protected $name = 'notifications';

	/**
	 * Constructor for Notifications
	 *
	 * @param string $name Alternative name for this group of notifications
	 */
	public function __construct ($name = null)
	{
		if(count($this->session->{$this->name})){
			foreach($this->session->{$this->name} as $notification){
				$this->add(Notification::fromString($notification));
			}
			$this->session->{$this->name} = null;
		}

		$this->addHookBefore('Session::redirect', $this, 'saveToSession');
	}

	/**
	 * Save the notifications to the session
	 */
	public function saveToSession ()
	{
		$notifications = array_map(function($notification){
			return (string) $notification;
		}, $this->getArray());
		$this->session->set($this->name, $notifications);
	}
}