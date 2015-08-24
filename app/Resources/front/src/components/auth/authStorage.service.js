'use strict';
const STORAGE_TOKEN_NAME = 'CALLBACK.AUTH_TOKEN';
const STORAGE_USER_NAME = 'CALLBACK.AUTH_USER';

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

  setUserId(_id) {
    this.storage.set(STORAGE_USER_NAME, _id);
  }

  getUserId() {
    return this.storage.get(STORAGE_USER_NAME);
  }

  removeUserId() {
    this.storage.remove(STORAGE_USER_NAME);
  }

  clear() {
    this.removeAuthToken();
    this.removeUserId();
  }
}

export default AuthStorage;
