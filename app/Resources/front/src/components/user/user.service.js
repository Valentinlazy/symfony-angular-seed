
/*@ngInject*/
export default class UserService {
  constructor(api, auth) {
    this.api = api;
    this.auth = auth;
  }
  getProfile() {
    let user = this.auth.getAuthUser();
    return this.api.get(`users/${user.id}`);
  }
  save(model) {
    return this.api.patch(`users/${model.id}`, model);
  }
}