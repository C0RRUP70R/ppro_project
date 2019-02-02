<?php

namespace app\controllers;

use app\models\Department;
use app\models\Employee;
use app\models\EmployeeInfo;
use app\models\HolidayType;
use app\models\NewRequestForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->render('index');
        }
        if (!Yii::$app->user->getIdentity()->isManager()) {
            $employee = Employee::findOne(Yii::$app->user->getId());
            $departments = [$employee->department];
        } else {
            $departments = Department::find()->all();
        }
        return $this->render('index', ['departments' => $departments]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string
     */
    public function actionNewRequest()
    {
        if (isset($_POST['NewRequestForm'])) {
            $model = new NewRequestForm($_POST['NewRequestForm']);
            if($model->createRequest()){
                \Yii::$app->getSession()->setFlash('success', 'Holiday request successfully commited');
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Holiday request not created');
            }
        }
        $model = new NewRequestForm();
        $types = HolidayType::allAsArray();
        return $this->render('new_request', ['model' => $model, 'types' => $types]);
    }

    /**
     * @return string
     */
    public function actionMyRequests()
    {
        $employee = Employee::findOne(Yii::$app->user->getId());
        return $this->render('my_requests', ['employee' => $employee]);
    }

    /**
     * @return string
     */
    public function actionApprovalRequests()
    {
        $employee = Employee::findOne(Yii::$app->user->getId());
        return $this->render('approval_requests', ['employee' => $employee]);
    }

    public function actionProfile()
    {
        $employee = Employee::findOne(Yii::$app->user->id);
        $employee_info = EmployeeInfo::findOne(Yii::$app->user->id);
        $department = Department::findOne($employee->department_pk);

        return $this->render('profile', ['employee' => $employee, 'employee_info' => $employee_info]);
    }

    public function actionApproveRequest($request){

    }

    public function actionCancellRequest($request){

    }

}
