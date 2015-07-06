
/*@ngInject*/
export default class DashboardCtrl {
  constructor($rootScope, $scope) {
    $rootScope.skin = 'skin-purple';
    $rootScope.sidebar = {
      'sidebar-mini':true,
      'sidebar-collapse':false
    };
    $scope.toggle = false;
    $scope.toggleSidebar = () => {
      $rootScope.sidebar = {
        'sidebar-mini':true,
        'sidebar-collapse':!$rootScope.sidebar['sidebar-collapse']
      };
    };
  }
}
