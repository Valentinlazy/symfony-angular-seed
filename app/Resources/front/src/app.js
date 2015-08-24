'use strict';
import angular from 'angular';
import 'angular-ui-router';
import 'storage';
import 'angular-cookies';
import 'bootstrap';
import 'clockpicker';
import 'angular-notify';
import 'ngMask/dist/ngMask';

import {appName} from './config/constants';
import authModule from './components/auth/index';
import UserComponent from './components/user/index';
import LoginPage from './pages/login/index';
import RegisterPage from './pages/register/index';
import ResetPasswordPage from './pages/reset-password/index';
import DashboardPage from './pages/dashboard/index';
import timeElement from './directives/time-element/index';
import convertToNumber from './directives/convert-to-number/index';

var app = angular.module(appName, [
  'angularLocalStorage',
  'ui.router',
  'cgNotify',
  'ngMask',
  authModule.name,
  LoginPage.name,
  RegisterPage.name,
  ResetPasswordPage.name,
  UserComponent.name,
  DashboardPage.name,
  timeElement.name,
  convertToNumber.name
])
  .config(($httpProvider, $urlRouterProvider, $locationProvider) => {
    $httpProvider.defaults.withCredentials = true;
    $httpProvider.interceptors.push('authInterceptor');

    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/dashboard/profile');
  })
  .run(($rootScope, $state, auth, $location, notify) => {

    $rootScope.$on('$stateChangeStart', (event, toState, toParams, fromState, fromParams) => {
      //For redirecting to view that is requested before 401/403 error fired.
      $rootScope.destinationState = {state: toState, stateParams: toParams};
      //To be used for UI back button //won't work when page is reloaded.
      $rootScope.previousState = {state: fromState, stateParams: fromParams};

      let allowAnonymous = (
        typeof toState.access === 'undefined' ||
        typeof toState.access.allowAnonymous === 'undefined') ? true : toState.access.allowAnonymous;

      if (!allowAnonymous && !auth.isAuthenticated()) {
        $location.path("/login");
      }
    });

    $rootScope.$on('api.access_denied', () => {
      $location.path("/login");
    });

    notify.config({
      position: 'center',
      duration: 2000
    });
  });

// INFO: Manual Application Bootstrapping
angular.element(document).ready(function() {
  angular.bootstrap(document, [appName]);
});

// INFO: Export app as so others may require it
export {app};
