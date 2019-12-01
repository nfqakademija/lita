import axios from 'axios';

export function getAcademies() {
    return axios.get('/api/v1/academies')
        .then( (response) => {
                return response.data;
            })
}

export function getExtendedAcademyInfo(id) {
    return axios.get(`/api/v1/academy/${id}`)
        .then( (response) => {
            return response.data;
        })
}
