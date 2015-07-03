const STORAGE_TOKEN_NAME = 'CALLBACK.AUTH_TOKEN';
const STORAGE_EMAIL_NAME = 'CALLBACK.AUTH_EMAIL';

class AuthStorage {
  /*@ngInject*/
  constructor(storage) {
    this.storage = storage;
  }

  setAuthToken(_token) {
    this.storage.set(STORAGE_TOKEN_NAME, _token);
  }

  getAuthToken() {
    return this.storage.get(STORAGE_TOKEN_NAME);
  }

  removeAuthToken() {
    this.storage.remove(STORAGE_TOKEN_NAME);
  }

  setUserEmail(_email) {
    this.storage.set(STORAGE_EMAIL_NAME, _email);
  }

  getUserEmail() {
    return this.storage.get(STORAGE_EMAIL_NAME);
  }

  removeUserEmail() {
    this.storage.remove(STORAGE_EMAIL_NAME);
  }

  clear() {
    this.removeAuthToken();
    this.removeUserEmail();
  }
}

export default AuthStorage;
