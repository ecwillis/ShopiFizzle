<?php

namespace ShopiFizzle\Resources;
use ShopiFizzle\Resources\Base;

class Products extends Base {
  public function list($count=30, $collection=null, $attrs=[]) {
    $attrs = array_merge($attrs, ['id', 'handle', 'title']);
    $attrStr = join($attrs, "        \n");

    $attrStr .= "
        featuredImage {
          id
          altText
          transformedSrc
        }";

    $qstr = ($collection !== null) ? ", query: \"collection_type:{$collection}\"" : '';
    $query = "{
  products(first:{$count}${qstr}) {
    edges {
      node {
        {$attrStr}
      }
    }
  }
}";
    $res = $this->_req($query);
    if (!$res->data) {
      throw new Error("Shopify API Error");
    }
    return $res->data;
  }
}
