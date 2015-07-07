import angular from 'angular';
import {appName} from '../../config/constants';
import DashboardController from './dashboard-controller';
import ProfilePage from '../profile/index';

let DashboardComponent = angular.module(`${appName}.dashboard`, [ProfilePage.name])
    .controller('DashboardCtrl', DashboardController)
    .config(($stateProvider, $urlRouterProvider) => {
      $stateProvider
        .state('dashboard', {
          abstract: true,
          url:'/dashboard',
          controller: 'DashboardCtrl',
          access: {allowAnonymous: false},
          templateUrl: '/pages/dashboard/index.html'
        })
      ;
      $urlRouterProvider.when('/dashboard', '/dashboard/profile');
    })
  ;

export default DashboardComponent;
