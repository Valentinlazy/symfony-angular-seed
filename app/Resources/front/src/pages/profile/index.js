import angular from 'angular';
import {appName} from '../../config/constants';
import ProfileController from './profile-controller';

let ProfileComponent = angular.module(`${appName}.profile`, [])
    .controller('ProfileCtrl', ProfileController)
    .config(($stateProvider) => {
      $stateProvider
        .state('dashboard.profile', {
          url:'/profile',
          controller: 'ProfileCtrl',
          access: {allowAnonymous: false},
          templateUrl: '/pages/profile/index.html'
        })
      ;
    })
  ;

export default ProfileComponent;
