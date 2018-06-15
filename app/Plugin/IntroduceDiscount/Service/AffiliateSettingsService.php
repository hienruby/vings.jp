<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Plugin\IntroduceDiscount\Service;

use Eccube\Application;
use Eccube\Common\Constant;

class AffiliateSettingsService
{
    // ====================================
    // 定数宣言
    // ====================================

    // ====================================
    // 変数宣言
    // ====================================
    /** @var \Eccube\Application */
    public $app;

    /** @var \Eccube\Entity\BaseInfo */
    public $BaseInfo;

    /**
     * コンストラクタ
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->BaseInfo = $app['eccube.repository.base_info']->get();
    }

    /**
     * 情報を更新する
     * @param unknown $data
     */
    public function update($data) {
        $em = $this->app['orm.em'];

        // 情報を取得する
        $afsettings =$this->app['eccube.plugin.introduce_discount.repository.affiliate_settings']->find($data['id']);
        if(is_null($afsettings)) {
            return false;
        }

        // 情報を書き換える
        $afsettings->setIntroduceConversionDiscountRate($data['introduce_conversion_discount_rate']);
        $afsettings->setMeetConversionDiscountRate($data['meet_conversion_discount_rate']);
        // 情報を更新する
        $em->persist($afsettings);
        $em->flush();

        return true;
    }

}
