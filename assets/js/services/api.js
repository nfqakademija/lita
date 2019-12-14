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

export function getTypeOptions() {
    return axios.get('/api/v1/programOptions')
        .then( (response) => {
            return response.data.program_names;
        })
}

export function getCityOptions() {
    return axios.get('/api/v1/cityOptions')
        .then( (response) => {
            return response.data.cities;
        })
}

export function filterAcademies(City, Program, Price) {
    return axios.get(
        '/api/v1/filter',
        {
            params: {
                City,
                Program,
                Price
            }
        })
        .then( (response) => {
            return response.data;
        })
}
