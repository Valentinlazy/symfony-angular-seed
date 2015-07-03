import angular from 'angular';
import {appName} from '../../config/constants';
import ApiProvider from './api.provider';

let ApiComponent = angular
    .module(`${appName}.api`, [])
    .provider('api', ApiProvider)
  ;

export default ApiComponent;