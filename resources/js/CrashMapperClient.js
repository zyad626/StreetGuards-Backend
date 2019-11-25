import axios from 'axios';

class CrashMapperClient {
    constructor() {
        this.baseurl = 'http://localhost/api';
        this.httpClient = axios.create({
            baseURL: this.baseurl
        });
    }

    get(endpoint, params) {
        return this.httpClient.get(endpoint, {
            params: params
        }).then(response => response.data);
    }

    post(endpoint, body, params) {
        return this.httpClient.post(endpoint, body).then(response => response.data);
    }
}

export { CrashMapperClient as default}
