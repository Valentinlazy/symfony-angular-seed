'use strict';
import angular from 'angular';
import {appName} from '../../config/constants';
import TimeElement from './time-element.directive';

let timeElement = angular.module(`${appName}.timeElement`, [])
  .directive('timeElement', TimeElement);

export default timeElement;