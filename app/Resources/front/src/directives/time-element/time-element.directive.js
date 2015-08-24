'use strict';

function TimeElement () {
  return {
    restrict: 'AE',
    link: (scope, el, attrs) => {
      el.clockpicker();
    }
  }
}

export default TimeElement;