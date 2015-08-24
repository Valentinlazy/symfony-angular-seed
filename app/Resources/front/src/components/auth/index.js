'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import AuthApi from './auth.api';
import AuthStorage from './authStorage.service';
import authInterceptor from './authInterceptor.service';
import AuthProvider from './auth.provider';
import apiModule from '../api/index';

let AuthComponent = angular.module(`${appName}.auth`, [apiModule.name])
    .provider('auth', AuthProvider)
    .service('authApi', AuthApi)
    .service('authStorage', AuthStorage)
    .service('authInterceptor', authInterceptor)
  ;

export default AuthComponent;
