import angular from 'angular';
import 'angular-ui-router';
import 'storage';
import 'angular-cookies';

import configModule from './config/config';
import {appName} from './config/constants';
import MainComponent from './components/main/index';
import authModule from './components/auth/index';
import LoginComponent from './pages/login/index';

var app = angular.module(appName, [
  'angularLocalStorage',
  'ui.router',
  authModule.name,
  configModule.name,
  MainComponent.name,
  LoginComponent.name
])
  .run(($rootScope, $state, auth, $location) => {

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
      auth.signout();
      $location.path("/login");
    });

  });

// INFO: Manual Application Bootstrapping
angular.element(document).ready(function() {
  angular.bootstrap(document, [appName]);
});

// INFO: Export app as so others may require it
export {app};
