'use strict';

class AuthModel {
  constructor(email, password) {
    this.email = email;
    this.password = password;
  }

  get signinData() {
    return {
      email: this.email,
      password: this.password
    };
  }

  get signupData() {
    return {
      email: this.email,
      fullName: this.fullName,
      password: this.password
    };
  }

  get forgotPasswordData() {
    return {
      email: this.email
    };
  }

  get signupDataValid() {
    return this.password === this.confirmPassword;
  }
}

export default AuthModel;
