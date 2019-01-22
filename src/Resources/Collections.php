<?php

namespace ShopiFizzle\Resources;
use ShopiFizzle\Resources\Base;

class Collections extends Base {
  public function __construct($url, $options) {
    parent::__construct($url, $options);
  }

  public function get($count=30, $attrs=[], $productsCount=3) {
    $attrs = array_merge($attrs, ['id', 'handle', 'title', 'productsCount']); 
    
    $attrStr = join($attrs,"\n        ");
    $query = "{
  collections(first:{$count}) {
    edges {
      node {
        {$attrStr}
        products(first:{$productsCount}) {
          edges {
            node {
              id
              handle
              title
              onlineStoreUrl
              featuredImage {
                id
                altText
                transformedSrc
              }
            }
          }
        }
      }
    }
  }
}";
    $res = $this->_req($query);
    if (!isset($res->data)) {
      echo "<pre>" . print_r($res, true);
      die();
      throw new Error("Shopify API Error");
    }
    return $res->data;
  }
}
