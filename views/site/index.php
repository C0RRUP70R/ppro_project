<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-12">
        <?php
        if (empty($departments)) {
            echo '<H2>Holiday Guide - please log in</H2>';
        } else {
            echo '<h2>All absences</h2>';
            foreach ($departments as $department) {
                echo "<h3>$department->department_name</h3>";
                echo \yii\grid\GridView::widget([
                    'dataProvider' => \app\components\AuxFunc::getDataProvider(
                        $department->getApprovedRequests()
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
                            'label' => 'Approved by',
                            'value' => function ($model) {
                                $info = $model->approver->employeeInfo;
                                return $info->first_name . ' ' . $info->last_name;
                            },
                            'headerOptions' => ['style' => 'width:14%']
                        ],
                    ],
                    'layout' => "{items}\n{summary}\n{pager}"
                ]);
            }
        }
        ?>
    </div>
</div>
