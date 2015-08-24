'use strict';

export default function () {
  return {
    require: 'ngModel',
    link: (scope, el, attrs, ngModel) => {
      ngModel.$parsers.push(function(val) {
        return parseInt(val, 10);
      });
      ngModel.$formatters.push(function(val) {
        return '' + val;
      });
    }
  };
}