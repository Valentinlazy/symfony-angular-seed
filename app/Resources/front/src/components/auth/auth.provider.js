import AuthModel from './auth.model';

class AuthProvider {
  /*@ngInject*/
  $get($q, authApi, authStorage) {
    var methods = {};

    ['signin', 'signup', 'forgotPassword'].forEach((_method) => {
      var methodData = _method + 'Data';

      methods[_method] = (_model) => {
        if (_model instanceof AuthModel) {
          authStorage.clear();
          return authApi[_method](_model[methodData]).then(successCallback, errorCallback);
        }

        return $q.reject('Unsupported type of data');
      };
    });

    methods.signout = () => {authStorage.clear()};
    methods.isAuthenticated = () => {!!authStorage.getAuthToken()};
    methods.getAuthUser = getUser;

    return methods;

    ////////////

    function getUser() {
      return {
        id: authStorage.getUserId()
      };
    }

    function successCallback(_result) {
      // handle success result here
      // result is an object of response which contains 'apiKey' property
      if (204 !== _result.status && _result.token) {
        authStorage.setAuthToken(_result.token);
        authStorage.setUserId(_result.user_id);
      }

      return _result;
    }

    function errorCallback(_result) {
      // handle error result here
      // result is an object of response which contains 'status' and 'statusText' properties
      return $q.reject(_result);
    }
  }
}

export default AuthProvider;
