<?php

namespace ShopiFizzle;

class Shop {
  protected $shopUrl;
  public $opts;

  protected $resources = [];

  public function __construct($url, $options) {
    $this->shopUrl = $url;
    $this->opts = $options; 
  }

  public function __get($var) {
    if (!isset($this->resources[$var])) {
      $className = ucfirst($var);
      $fqName = "ShopiFizzle\Resources\\{$className}";
      
      $this->resources[$var] = new $fqName($this->shopUrl, $this->opts);
    }

    return $this->resources[$var];

  }
}
