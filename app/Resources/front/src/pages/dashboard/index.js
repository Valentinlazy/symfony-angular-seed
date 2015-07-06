import angular from 'angular';
import {appName} from '../../config/constants';
import DashboardController from './dashboard-controller';

let DashboardComponent = angular.module(`${appName}.dashboard`, [])
    .controller('DashboardCtrl', DashboardController)
    .config(($stateProvider) => {
      $stateProvider
        .state('dashboard', {
          url:'/dashboard',
          controller: 'DashboardCtrl',
          access: {allowAnonymous: false},
          templateUrl: '/pages/dashboard/index.html'
        })
      ;
    })
  ;

export default DashboardComponent;
