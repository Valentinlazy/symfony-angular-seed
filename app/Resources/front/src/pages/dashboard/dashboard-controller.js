
/*@ngInject*/
export default class DashboardCtrl {
  constructor($rootScope, $scope, auth) {
    $rootScope.skin = 'skin-purple';
    $rootScope.sidebar = {
      'sidebar-mini':true,
      'sidebar-collapse':false
    };
    $scope.toggle = false;
    $scope.toggleSidebar = () => {
      $rootScope.sidebar['sidebar-collapse'] = !$rootScope.sidebar['sidebar-collapse'];
      $rootScope.sidebar = $rootScope.sidebar; // гавнуляр по другому не хочет работать ;(
    };
    $scope.signout = (e) => {
      auth.signout();
    };
  }
}
