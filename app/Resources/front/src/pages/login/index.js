'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import LoginController from './login-controller';

let LoginComponent = angular.module(`${appName}.login`, [])
    .controller('LoginCtrl', LoginController)
    .config(($stateProvider) => {
      $stateProvider
        .state('login', {
          url:'/login',
          controller: 'LoginCtrl as ctrl',
          access: {allowAnonymous: true},
          templateUrl: '/pages/login/index.html'
        })
      ;
    })
  ;

export default LoginComponent;
