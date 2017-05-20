<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;

class AdminController extends Controller {

  /**
   * @Route("/admin/new-product", name="new-product")
   */
  public function newProductAction(Request $request) {
    $product = new Product;
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $product = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->getRepository('AppBundle:Product')->saveNewProduct($em, $product);
      $this->sendProductNotificationEmail($product->getId());
      $this->addFlash('notice', 'Product Created');

      return $this->redirectToRoute('new-product');
    }
    return $this->render('admin/new-product.html.twig', array('form' => $form->createView()));
  }

  public function sendProductNotificationEmail($id) {
    $message = \Swift_Message::newInstance()
            ->setSubject('New product notification')
            ->setFrom('send@example.com')
            ->setTo('fake@example.com')
            ->setBody(
            $this->renderView(
                    'Emails/newProductNotification.html.twig', array('id' => $id)
            )
    );
    $this->get('mailer')->send($message);
  }
}
