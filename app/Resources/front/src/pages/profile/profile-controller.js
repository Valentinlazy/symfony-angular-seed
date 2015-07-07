
/*@ngInject*/
export default class ProfileCtrl {
  constructor($scope, model, userService) {
    $scope.model = model;
    $scope.submit = (e) => {
      userService.save($scope.model);
    };
  }
}
