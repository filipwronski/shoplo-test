<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase {

  /**
   * @dataProvider urlAdminProvider
   */
  public function testAdminPageIsSuccessful($url) {
    $client = self::createClient(array(), array(
                'PHP_AUTH_USER' => 'USER_NAME',
                'PHP_AUTH_PW' => 'USER_PASSWORD',
    ));
    $client->request('GET', $url);

    $this->assertTrue($client->getResponse()->isSuccessful());
  }

  public function urlAdminProvider() {
    return array(
        array('/'),
        array('/admin/new-product'),
        array('/login'),
        array('/register/'),
    );
  }
  
  public function testProductsListPage() {
    $client = static::createClient();

    $crawler = $client->request('GET', '/');

    $this->assertGreaterThan(
            0, $crawler->filter('html:contains("Name")')->count()
    );
  }

}
