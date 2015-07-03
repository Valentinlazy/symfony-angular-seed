import angular from 'angular';
import {appName} from '../../config/constants';
import MainController from './main-controller';

let MainComponent = angular.module(`${appName}.main`, [])
    .controller('MainCtrl', MainController)
    .config(($stateProvider, $urlRouterProvider) => {
      $stateProvider
        .state('dashboard', {
          url:'/dashboard',
          controller: 'MainCtrl as ctrl',
          access: {allowAnonymous: false},
          templateUrl: '/components/main/index.html'
        })
      ;

      $urlRouterProvider.otherwise('/dashboard');
    })
  ;

export default MainComponent;
