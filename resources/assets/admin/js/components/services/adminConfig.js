const location = window.location;
//educational-system-api.dev

export default {
    // HOST: `${location.protocol}//${location.hostname}:${location.port}`,
    HOST: `${location.protocol}//${location.hostname}`,

    get API_URL() {
        return `${this.HOST}/admin/api`;
    },

    get ADMIN_URL() {
        return `${this.HOST}/admin`;
    }
}