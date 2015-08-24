'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import RegisterController from './register-controller';

let RegisterComponent = angular.module(`${appName}.register`, [])
    .controller('RegisterCtrl', RegisterController)
    .config(($stateProvider) => {
      $stateProvider
        .state('register', {
          url:'/register',
          controller: 'RegisterCtrl as ctrl',
          access: {allowAnonymous: true},
          templateUrl: '/pages/register/index.html'
        })
      ;
    })
  ;

export default RegisterComponent;
