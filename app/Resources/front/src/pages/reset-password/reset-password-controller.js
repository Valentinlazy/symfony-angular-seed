import AuthModel from '../../components/auth/auth.model';

/*@ngInject*/
export default class ResetPasswordCtrl {
  constructor($scope, auth, $state) {
    $scope.model = new AuthModel();
    $scope.formErrors = '';
    $scope.submit = () => {
        $scope.isPending = true;
        auth.forgotPassword($scope.model).then(
          ()=>{
              $scope.isPending = false;
              $state.transitionTo('login');
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
