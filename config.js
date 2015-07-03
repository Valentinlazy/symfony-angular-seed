System.config({
  "transpiler": "babel",
  "babelOptions": {
    "optional": [
      "es7.decorators",
      "es7.classProperties",
      "runtime"
    ]
  },
  "paths": {
    "*": "*.js",
    "github:*": "jspm_packages/github/*.js",
    "npm:*": "jspm_packages/npm/*.js",
    "angular-es6/*": "lib/*.js"
  },
  "baseUrl": "web"
});

System.config({
  "map": {
    "admin-lte": "github:almasaeed2010/AdminLTE@2.1.2",
    "angular": "github:angular/bower-angular@1.4.0",
    "angular-cookies": "github:angular/bower-angular-cookies@1.4.1",
    "angular-mocks": "github:angular/bower-angular-mocks@1.4.0",
    "angular-ui-router": "github:angular-ui/ui-router@0.2.15",
    "babel": "npm:babel-core@5.5.7",
    "babel-runtime": "npm:babel-runtime@5.5.7",
    "bootstrap": "github:twbs/bootstrap@3.3.4",
    "core-js": "npm:core-js@0.9.16",
    "jquery": "github:components/jquery@2.1.3",
    "storage": "github:agrublev/angularLocalStorage@0.3.0",
    "traceur": "github:jmcriffey/bower-traceur@0.0.88",
    "traceur-runtime": "github:jmcriffey/bower-traceur-runtime@0.0.88",
    "github:agrublev/angularLocalStorage@0.3.0": {
      "angular": "github:angular/bower-angular@1.4.0",
      "angular-cookies": "github:angular/bower-angular-cookies@1.4.1"
    },
    "github:angular-ui/ui-router@0.2.15": {
      "angular": "github:angular/bower-angular@1.4.0"
    },
    "github:angular/bower-angular-cookies@1.4.1": {
      "angular": "github:angular/bower-angular@1.4.0"
    },
    "github:angular/bower-angular-mocks@1.4.0": {
      "angular": "github:angular/bower-angular@1.4.0"
    },
    "github:jspm/nodelibs-process@0.1.1": {
      "process": "npm:process@0.10.1"
    },
    "github:twbs/bootstrap@3.3.4": {
      "jquery": "github:components/jquery@2.1.3"
    },
    "npm:babel-runtime@5.5.7": {
      "process": "github:jspm/nodelibs-process@0.1.1"
    },
    "npm:core-js@0.9.16": {
      "fs": "github:jspm/nodelibs-fs@0.1.2",
      "process": "github:jspm/nodelibs-process@0.1.1",
      "systemjs-json": "github:systemjs/plugin-json@0.1.0"
    }
  }
});

