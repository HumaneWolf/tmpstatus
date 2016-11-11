<?php

class Servers {
	private $client;

	private $serversPath = __DIR__ . '/data/servers.json';
	private $timePath = __DIR__ . '/data/time';


	function __construct($apiclient) {
		$this->client = $apiclient;
	}

	function timeSinceLastUpdate() {
		$time = file_get_contents($this->timePath);
		return time() - intval($time);
	}

	function update() {
		$servers = $this->client->servers();

		file_put_contents($this->serversPath, json_encode($servers->servers));
		file_put_contents($this->timePath, time());
	}

	function fetchAsJson() {
		if ($this->timeSinceLastUpdate() > 59) {
			$this->update();
		}
		$servers = file_get_contents($this->serversPath);
		return $servers;
	}

	function fetchAsObject() {
		return json_decode($this->fetchAsJson());
	}
}	