<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

  /**
   * @Route("/", name="list-products")
   */
  public function indexAction(Request $request) {

    $em = $this->getDoctrine()->getManager();
    $productListQuery = $em->getRepository('AppBundle:Product')->getProductListQuery($em);
    $pagination = $this->getPagination($productListQuery, $request);
    return $this->render('default/index.html.twig', ['pagination' => $pagination]);
  }

  public function getPagination($productListQuery, $request) {
    $paginator = $this->get('knp_paginator');
    return $paginator->paginate(
                    $productListQuery, $request->query->getInt('page', 1), 10, ['defaultSortFieldName' => 'p.createTime', 'defaultSortDirection' => 'desc']
    );
  }

}
