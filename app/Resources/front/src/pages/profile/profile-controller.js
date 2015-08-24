'use strict';
import angular from 'angular';

/*@ngInject*/
export default class ProfileCtrl {
  constructor($scope, $rootScope, userService, profile, notify) {
    $scope.model = profile;
    $scope.submit = (e) => {
      userService.save($scope.model).then((res)=> {
        $scope.model = res;
        $rootScope.user = angular.copy($scope.model);
        notify('Успешно сохранено!');
      });
    };
  }
}
