<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 20.01.2019
 * Time: 10:55
 */

echo '<h2>Approval Requests</h2>';
?>
<div class="row">
    <div class="col-lg-12">
        <?php

        $departments = $employee->myDepartments;

        if (empty($departments)) {
            echo '<h3>No departments available</h3>';
        } else {
            foreach ($departments as $department) {
                echo "<h3>$department->department_name</h3>";
                echo \yii\grid\GridView::widget([
                    'dataProvider' => \app\components\AuxFunc::getDataProvider(
                        $department->getUnapprovedRequests()
                    ),
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
                            'label' => 'Approve',
                            'format' => 'html',
                            'value' => function ($model) {
                                $str = '<span>';
                                $str .= '<a href="?r=site%2Fapprove-request&request='.$model->holiday_request_pk.'" class="glyphicon glyphicon-check" style="margin-left: 15px"></a>';
                                $str .= '<a href="?r=site%2Fcancel-request&request='.$model->holiday_request_pk.'" class="glyphicon glyphicon-erase"style="margin-left: 15px"></a>';
                                $str .= '</span>';
                                return $str;
                            },
                            'headerOptions' => ['style' => 'width:5%']
                        ],
                    ],
                    'layout' => "{items}\n{summary}\n{pager}"
                ]);
            }
        }
        ?>
    </div>
</div>