# Yii2-extension-for-socail-network-and-partners
Extension for Yii2 auth partners

Exapmle:



  
    public function actionLogin($provider = null) {
      if ($provider !== null) {
          $provider = Yii::$app->provider->getIdentity($provider);
          $form = $provider->getForm();
          
          if (Yii::$app->request->getIsPost()) {
              $form->setAttributes($this->post());
    
              if ($form->validate()) {
                  $authService = Yii::$app->authService;
                  $userInfo = $loginResult = $provider->authenticate();
                  
                  return $this->render($userInfo);
              } else {
                  $allErrors = $form->getFirstErrors();
                  throw new HttpException(403, reset($allErrors));
              }
          }
      }
    
      return $this->render('login', ['form' => $provider->getFormView()]);
    }
  
