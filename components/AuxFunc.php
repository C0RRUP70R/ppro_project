<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 19:59
 */

namespace app\components;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class AuxFunc
{
    public static function createNavItems()
    {
        $items = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $items[] = ['label' => 'New request', 'url' => ['/site/new-request']];
            $items[] = ['label' => 'My requests', 'url' => ['/site/my-requests']];
            if (Yii::$app->user->getIdentity()->isManager()) {
                $items[] = ['label' => 'Approval requests', 'url' => ['/site/approval-requests']];
            }
            $items[] = ['label' => 'Profile', 'url' => ['/site/profile']];
            $items[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        return $items;
    }

    public static function getDataProvider($query)
    {
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }
}