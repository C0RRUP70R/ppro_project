<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 20.01.2019
 * Time: 10:55
 */

use app\components\AuxFunc;
use app\models\Employee;

?>

<h2>My requests</h2>
<h3>Approved</h3>
<?= \yii\grid\GridView::widget([
        'dataProvider' => AuxFunc::getDataprovider($employee->getApprovedRequests()),
        'columns' => [
            ['attribute' => 'employee.employeeInfo.first_name',
                'label' => 'Name',
                'headerOptions' => ['style' => 'width:15%']
            ],
            ['attribute' => 'employee.employeeInfo.last_name',
                'label' => 'Last name',
                'headerOptions' => ['style' => 'width:15%']
            ],
            ['attribute' => 'holiday_type',
                'label' => 'Type',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'start_date',
                'label' => 'Start',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'end_date',
                'label' => 'End',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'duration',
                'label' => 'Duration (days)',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'approved_by',
                'label' => 'Approved by',
                'value' => function($model){
                            $info = $model->approver->employeeInfo;
                            return $info->first_name . ' ' . $info->last_name;
                },
                'headerOptions' => ['style' => 'width:14%']
            ],
            ['attribute' => 'action',
                'label' => 'Action',
                'format' => 'html',
                'value' => function ($model) {
                    $str = '<span>';
                    $str .= '<a href="?r=site%2Fcancel-request&request='.$model->holiday_request_pk.'" class="glyphicon glyphicon-erase"style="margin-left: 15px"></a>';
                    $str .= '</span>';
                    return $str;
                },
                'headerOptions' => ['style' => 'width:5%']
            ],
        ],
        'layout' => "{items}\n{summary}\n{pager}",
    ]
); ?>
<h3>Waiting</h3>
<?= \yii\grid\GridView::widget([
        'dataProvider' => AuxFunc::getDataprovider($employee->getUnapprovedRequests()),
        'columns' => [
            ['attribute' => 'employee.employeeInfo.first_name',
                'label' => 'Name',
                'headerOptions' => ['style' => 'width:15%']
            ],
            ['attribute' => 'employee.employeeInfo.last_name',
                'label' => 'Last name',
                'headerOptions' => ['style' => 'width:15%']
            ],
            ['attribute' => 'holiday_type',
                'label' => 'Type',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'start_date',
                'label' => 'Start',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'end_date',
                'label' => 'End',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'duration',
                'label' => 'Duration (days)',
                'headerOptions' => ['style' => 'width:10%']
            ],
            ['attribute' => 'approved_by',
                'label' => 'Approved by',
                'value' => function($model){
                    try {
                        $info = $model->approver->employeeInfo;
                        return $info->first_name . ' ' . $info->last_name;
                    } catch (Exception $e){
                        return null;
                    }
                },
                'headerOptions' => ['style' => 'width:14%']
            ],
            ['attribute' => 'action',
                'label' => 'Action',
                'format' => 'html',
                'value' => function ($model) {
                    $str = '<span>';
                    $str .= '<a href="?r=site%2Fcancel-request&request='.$model->holiday_request_pk.'" class="glyphicon glyphicon-erase"style="margin-left: 15px"></a>';
                    $str .= '</span>';
                    return $str;
                },
                'headerOptions' => ['style' => 'width:5%']
            ],
        ],
        'layout' => "{items}\n{summary}\n{pager}",
    ]
); ?>
