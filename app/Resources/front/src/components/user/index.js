import angular from 'angular';
import {appName} from '../../config/constants';
import UserService from './user.service';

let UserComponent = angular
    .module(`${appName}.user`, [])
    .service('userService', UserService);

export default UserComponent;

