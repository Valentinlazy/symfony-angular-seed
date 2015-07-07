
/*@ngInject*/
export default class DashboardCtrl {
  constructor($rootScope, $scope, auth, model) {
    $rootScope.skin = 'skin-purple';
    $rootScope.sidebar = {
      'sidebar-mini':true,
      'sidebar-collapse':false
    };
    $scope.model = model;
    $scope.toggleSidebar = () => {
      $rootScope.sidebar['sidebar-collapse'] = !$rootScope.sidebar['sidebar-collapse'];
      $rootScope.sidebar = $rootScope.sidebar; // гавнуляр по другому не хочет работать ;(
    };
    $scope.signout = (e) => {
      auth.signout();
    };
  }
}
