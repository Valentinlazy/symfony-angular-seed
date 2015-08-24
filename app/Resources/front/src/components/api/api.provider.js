'use strict';
import angular from 'angular';
import {host} from '../../config/constants';

class ApiProvider {
  /*@ngInject*/
  $get($http, $q) {
    var methods = {};

    ['GET', 'DELETE'].forEach(function (method) {
      methods[method.toLowerCase()] = function (uri, config) {
        config = config || {};
        config.method = method;
        config.url = uri;

        return doRequest(config);
      };
    });

    ['POST', 'PUT', 'PATCH'].forEach(function (method) {
      methods[method.toLowerCase()] = function (uri, data, config) {
        config = config || {};
        data = angular.copy(data); // clean up and copy data to make it immutable
        config.method = method;
        config.url = uri;
        config.data = data;

        return doRequest(config);
      };
    });

    methods.defaults = {
      requestTransformer: [],
      responseTransformer: [],
      withCredentials: true,
      headers: {
        'Content-Type': 'application/json'
      }
    };

    return methods;

    ////////////

    function doRequest(_cfg) {
      _cfg = angular.extend(_cfg, methods.defaults);
      _cfg.url = host + _cfg.url;

      angular.extend(_cfg.headers, methods.defaults.headers || {});

      return $http(_cfg).then(
        (_response) => { return _response.data; },
        (_reason) => { return $q.reject(_reason); }
      );
    }
  }
}

export default ApiProvider;
