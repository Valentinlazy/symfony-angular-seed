import AuthModel from './auth.model';

class AuthProvider {
  /*@ngInject*/
  $get($q, authApi, authStorage) {
    var methods = {};

    ['signin', 'signup', 'forgotPassword'].forEach((_method) => {
      var methodData = _method + 'Data';
      authStorage.clear();

      methods[_method] = (_model) => {
        if (_model instanceof AuthModel) {
          return authApi[_method](_model[methodData]).then(successCallback, errorCallback);
        }

        return $q.reject('Unsupported type of data');
      };
    });

    methods.signout = () => authStorage.clear();
    methods.isAuthenticated = () => !!authStorage.getUserEmail();
    methods.getAuthUser = getUser;

    return methods;

    ////////////

    function getUser() {
      return {
        email: authStorage.getUserEmail()
      };
    }

    function successCallback(_result) {
      // handle success result here
      // result is an object of response which contains 'apiKey' property
      if (204 !== _result.status && _result.apiKey && _result.email) {
        authStorage.setAuthToken(_result.apiKey);
        authStorage.setUserEmail(_result.email);
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
