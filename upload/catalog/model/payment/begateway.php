<?php
class ModelPaymentBegateway extends Model {

  const DEMO_SHOP_ID  = '361';
  const DEMO_SHOP_KEY = 'b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d';

  const DEMO_GATEWAY_URL  = 'demo-gateway.begateway.com';
  const DEMO_CHECKOUT_URL = 'checkout.begateway.com';

  static function getPaymentMethods() {
    return array('credit_card', 'halva', 'erip');
  }

  public function getMethod($address, $total) {
    $this->load->language('payment/begateway');

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('begateway_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

    if ($this->config->get('begateway_total') > 0 && $this->config->get('begateway_total') > $total) {
      $status = false;
    } elseif (!$this->config->get('begateway_geo_zone_id')) {
      $status = true;
    } elseif ($query->num_rows) {
      $status = true;
    } else {
      $status = false;
    }

    $method_data = array();

    if ($status) {
      $method_data = array(
        'code'       => 'begateway',
        'title'      => $this->language->get('text_title'),
        'terms'      => '',
        'sort_order' => $this->config->get('begateway_sort_order')
      );
    }

    return $method_data;
  }
}

?>
