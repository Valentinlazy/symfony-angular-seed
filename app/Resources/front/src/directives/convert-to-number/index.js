'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import convertToNumber from './convert-to-number.directive';

let toNumber = angular.module(`${appName}.convertToNumber`, [])
  .directive('convertToNumber', convertToNumber);

export default toNumber;