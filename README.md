# Yii2-extension-for-socail-network-and-partners
Extension for Yii2 auth partners

Exapmle using:



  public function actionLogin($provider = null) {
    if ($provider !== null) {
        $provider = Yii::$app->provider->getIdentity($provider);
        $form = $provider->getForm();
        
        if ($this->isPost()) {
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
  
        return $this->render(['form' => $provider->getFormView()]);
    }
  }
