import AuthModel from '../../components/auth/auth.model';

/*@ngInject*/
export default class RegisterCtrl {
  constructor($scope, auth, $state) {
    $scope.model = new AuthModel();
    $scope.formErrors = '';
    $scope.submit = () => {
        $scope.isPending = true;
        auth.signup($scope.model).then(
          ()=>{
            auth.signin($scope.model).then(
              ()=>{
                $scope.isPending = false;
                $state.transitionTo('dashboard');
              });
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
