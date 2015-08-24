'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import ResetPasswordController from './reset-password-controller';

let ResetPasswordComponent = angular.module(`${appName}.resetPassword`, [])
    .controller('ResetPasswordCtrl', ResetPasswordController)
    .config(($stateProvider) => {
      $stateProvider
        .state('reset-password', {
          url:'/reset-password',
          controller: 'ResetPasswordCtrl as ctrl',
          access: {allowAnonymous: true},
          templateUrl: '/pages/reset-password/index.html'
        })
      ;
    })
  ;

export default ResetPasswordComponent;
