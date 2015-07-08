import angular from 'angular';

/*@ngInject*/
export default class ProfileCtrl {
  constructor($scope, $rootScope, userService, model) {
    $scope.model = model;
    $scope.submit = (e) => {
      userService.save($scope.model).then((res)=>$rootScope.user=angular.copy($scope.model));
    };
  }
}
