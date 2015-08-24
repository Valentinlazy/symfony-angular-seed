'use strict';
import {host, TOKEN_HEADER_NAME} from '../../config/constants';

function authInterceptor($rootScope, $q, authStorage) {
  var apiRegexp = new RegExp('^' + host);

  return {
    request: function (config) {
      if (apiRegexp.test(config.url) && authStorage.getAuthToken()) {
        config.headers[TOKEN_HEADER_NAME] = authStorage.getAuthToken();
      }

      return config;
    },
    responseError: function (rejection) {
      var config = rejection.config || {},
          status = rejection.status;

      if (apiRegexp.test(config.url)) {
        if (403 === status || 401 === status) {
          authStorage.clear();
          $rootScope.$broadcast('api.access_denied');
        }
      }

      return $q.reject(rejection);
    }
  };
}

authInterceptor.$inject = ['$rootScope', '$q', 'authStorage'];

export default authInterceptor;
