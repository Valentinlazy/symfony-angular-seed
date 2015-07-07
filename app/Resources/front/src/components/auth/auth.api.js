'use strict';

class AuthApi {
  /*@ngInject*/
  constructor(api) {
    this.api = api;
  }

  signup(_data) {
    return this.api.post('users', {
      email: _data.email,
      fullName: _data.fullName,
      password: _data.password
    });
  }

  signin(_data) {
    return this.api.post('sessions', {
      email: _data.email,
      password: _data.password
    });
  }

  forgotPassword(_data) {
    return this.api.post('users/reset', {
      email: _data.email
    });
  }

}

export default AuthApi;
