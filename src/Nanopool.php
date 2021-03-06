<?php
namespace Krorten\Nanopool;

use GuzzleHttp\Client;

class Nanopool {

	const API = "https://api.nanopool.org/v1/";

	protected $type = 'zec';

	public function setType($type = 'zec')
	{
		$this->type = $type;

		return $this;
	}
	/**
	 * Get a summary of current address
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function user($adress)
	{
		return $this->request('user/' . $adress);
	}
	/**
	 * Get workers from current adress
	 * @param  [type] $adress [description]
	 * @return [type]         [description]
	 */
	public function workers($adress)
	{
		return $this->request('workers/' . $adress);
	}
	/**
	 * Get current balance and Hashrate
	 * @param  [type] $adress [description]
	 * @return [type]         [description]
	 */
	public function balancehs($adress)
	{
		return $this->request('balance_hashrate/' . $adress);
	}
	/**
	 * Getting curring Hashrate in Mh/s
	 * @param  [type] $adress [description]
	 * @return [type]         [description]
	 */
	public function hashrate($adress)
	{
		return $this->request('hashrate/' . $adress);
	}	
	/**
	 * Get list of paymets
	 * @param  [type] $adress [description]
	 * @return [type]         [description]
	 */
	public function payments($adress)
	{
		return $this->request('payments/' . $adress);
	}
	/**
	 * Get approx earnings from current hashrate
	 * @param  [type] $hashrate [description]
	 * @return [type]           [description]
	 */
	public function calculator($hashrate)
	{
		return $this->request('approximated_earnings/' . $hashrate);
	}

	private function request($endpoint, $params = array())
	{
		$client = new Client();
		$qry = '';
		if (!empty($params)) {
			$qry = '?' . http_build_query($params);
		}

		$request = $client->request('GET', self::API . $this->type . '/' . $endpoint . $qry);
		$response = $request->getBody();
		return json_decode($response->getContents());
	}
}