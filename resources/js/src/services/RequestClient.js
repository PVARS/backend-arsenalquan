import axios from 'axios';

const baseDomain = 'http://127.0.0.1:8000/api';
const baseURL = `${baseDomain}/v1/admin`;
let accessToken = JSON.parse(localStorage.getItem('user_info'));

export default axios.create({
    baseURL,
    headers: {
        'Authorization': 'Bearer' + accessToken['access_token']
    }
})