import angular from 'angular';

/*@ngInject*/
export default class DashboardCtrl {
  constructor($rootScope, $scope, auth, model) {
    $rootScope.skin = 'skin-purple';
    $rootScope.sidebar = {
      'sidebar-mini':true,
      'sidebar-collapse':true
    };
    $rootScope.user = angular.copy(model);
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
