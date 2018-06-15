<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\NewItem\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class NewItemController
{
  public function index(Application $app)
  {
    $newItemList = $app['orm.em']->getRepository('\Eccube\Entity\Product')
          ->findBy(
              array('Status' => 1,
                    'del_flg' => 0),
              array('id' => 'DESC'),
              8,
              0
          );

      return $app->render('Block/newitem.twig', array(
          'newItemList' => $newItemList
      ));
  }
}
