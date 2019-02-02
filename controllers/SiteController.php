<?php

namespace app\controllers;

use app\models\ChangePasswordForm;
use app\models\Department;
use app\models\Employee;
use app\models\EmployeeInfo;
use app\models\HolidayRequest;
use app\models\HolidayType;
use app\models\NewRequestForm;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
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
        if (Yii::$app->user->isGuest) {
            return $this->render('index', ['departments' => []]);
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
            if ($model->createRequest()) {
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

        return $this->render('profile', ['employee' => $employee]);
    }

    public function actionApproveRequest($request)
    {
        $request_model = HolidayRequest::findOne($request);
        if (!empty($request_model)) {
            try {
                //  dependency injection
                if (Yii::$container->invoke([$request_model, 'approve'])) {
                    \Yii::$app->getSession()->setFlash('success', 'Request approved');
                } else {
                    \Yii::$app->getSession()->setFlash('error', 'Request not approved');
                }
            } catch (NotInstantiableException $e) {
            } catch (InvalidConfigException $e) {
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCancelRequest($request)
    {
        $request_model = HolidayRequest::findOne($request);
        if (!empty($request_model)) {
            try {
                //  dependency injection
                if (Yii::$container->invoke([$request_model, 'cancel'])) {
                    \Yii::$app->getSession()->setFlash('success', 'Request cancelled');
                } else {
                    \Yii::$app->getSession()->setFlash('error', 'Request not cancelled');
                }
            } catch (NotInstantiableException $e) {
            } catch (InvalidConfigException $e) {
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionChangePassword()
    {

        if (isset($_POST['ChangePasswordForm'])) {
            $model = new ChangePasswordForm($_POST['ChangePasswordForm']);
            if ($model->checkAndChange()) {
                \Yii::$app->getSession()->setFlash('success', 'Password was successfully changed.');
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Error occurred during change password.');
            }

            return $this->redirect('?r=site%2Fprofile');
        }
        $model = new ChangePasswordForm();
        return $this->render('change_password', ['model' => $model]);
    }

}
