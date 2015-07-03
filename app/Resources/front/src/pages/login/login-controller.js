import AuthModel from '../../components/auth/auth.model';

/*@ngInject*/
export default class LoginCtrl {
  constructor($scope, auth, $state) {
    $scope.model = new AuthModel();
    $scope.formErrors = '';
    $scope.submit = () => {
        $scope.isPending = true;
        auth.signin($scope.model).then(
          ()=>{
            $scope.isPending = false;
            $state.transitionTo('dashboard');
          },
          (_response)=>{
            $scope.isPending = false;
            if (_response && 401 === _response.status) {
              $scope.formErrors = 'Wrong email or password';
            }
          });
      };
  }
}
