import angular from 'angular';
import {appName} from './constants';

let configComponent = angular.module(`${appName}.core`, []);

configComponent
  .config(($httpProvider, $urlRouterProvider, $locationProvider) => {
    $httpProvider.defaults.withCredentials = true;
    $httpProvider.interceptors.push('authInterceptor');

    $locationProvider.html5Mode(true);
  });

export default configComponent;
