import angular from 'angular';
import {appName} from '../../config/constants';
import ProfileController from './profile-controller';
import UserComponent from '../../components/user/index';

let ProfileComponent = angular.module(`${appName}.profile`, [UserComponent.name])
    .controller('ProfileCtrl', ProfileController)
    .config(($stateProvider) => {
      $stateProvider
        .state('dashboard.profile', {
          url:'/profile',
          controller: 'ProfileCtrl',
          access: {allowAnonymous: false},
          templateUrl: '/pages/profile/index.html',
          resolve: {
            model: (userService) => userService.getProfile()
          }
        })
      ;
    })
  ;

export default ProfileComponent;
