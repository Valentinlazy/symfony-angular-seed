'use strict';
import angular from 'angular';

/*@ngInject*/
export default class DashboardCtrl {
  constructor($rootScope, $scope, auth, profile) {
    $rootScope.skin = 'skin-purple';
    $rootScope.sidebar = {
      'sidebar-mini':true,
      'sidebar-collapse':false
    };
    $rootScope.user = angular.copy(profile);
    $scope.toggleSidebar = () => {
      $rootScope.sidebar = angular.merge(
        {},
        $rootScope.sidebar,
        {'sidebar-collapse': !$rootScope.sidebar['sidebar-collapse']}
      );
    };
    $scope.signout = (e) => {
      auth.signout();
    };
  }
}
