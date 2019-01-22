<?php

namespace ShopiFizzle\Resources;

use GuzzleHttp\Client as GClient;

class Base {
  public $client;
  protected $opts;
  public function __construct($url, $options) {
    $this->client = new GClient([
      'base_uri' => $url,
      'timeout' => 30.0
    ]);
    $this->opts = $options;
  }

  public function _req($query) {
    $response = $this->client->request('POST', '/admin/api/graphql.json', [
      'headers' => [
        'X-Shopify-Access-Token' => $this->opts['api-key']
      ],
      'json' => ['query' => $query]
    ]);
    $body = $response->getBody()->getContents();

    return json_decode($body);
  }
}
