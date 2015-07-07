import AuthModel from '../../components/auth/auth.model';

/*@ngInject*/
export default class LoginCtrl {
  constructor($scope, auth, $state, $rootScope) {
    $scope.model = new AuthModel();
    $scope.formErrors = '';
    $scope.submit = () => {
        $scope.isPending = true;
        auth.signin($scope.model).then(
          ()=>{
            $scope.isPending = false;
            if($rootScope.destinationState.state && $rootScope.destinationState.state.name != 'login') {
              $state.transitionTo($rootScope.destinationState.state, $rootScope.destinationState.stateParams);
            } else {
              $state.transitionTo('dashboard.profile');
            }
          },
          (_response)=>{
            $scope.isPending = false;
            if (_response) {
              $scope.formErrors = _response.data;
            }
          });
      };
  }
}
