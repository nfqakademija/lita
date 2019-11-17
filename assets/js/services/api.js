import axios from 'axios';

export function getAcademies() {
    return axios.get('/api/v1/academies')
        .then( (response) => {
                return response.data;
            })
    /*return new Promise(resolve => {
        setTimeout(() => resolve(
            [
                {
                    academy_id: 1,
                    academy_name: 'NFQ Academy',
                    academy_email: 'akademija@nfq.lt',
                    academy_url: 'wwww.nfq.lt/nfq-academy',
                    academy_logo: 'https://avatars0.githubusercontent.com/u/4995607?v=3&s=100',
                    description: 'Super cool academy, with tons of homeworks',
                    price: false
                },
                {
                    academy_id: 2,
                    academy_name: 'NFQ Academy',
                    academy_email: 'akademija@nfq.lt',
                    academy_url: 'wwww.nfq.lt/nfq-academy',
                    academy_logo: 'https://avatars0.githubusercontent.com/u/4995607?v=3&s=100',
                    description: 'Super cool academy, with tons of homeworks',
                    price: false
                },
                {
                    academy_id: 3,
                    academy_name: 'NFQ Academy',
                    academy_email: 'akademija@nfq.lt',
                    academy_url: 'wwww.nfq.lt/nfq-academy',
                    academy_logo: 'https://avatars0.githubusercontent.com/u/4995607?v=3&s=100',
                    description: 'Super cool academy, with tons of homeworks',
                    price: false
                },
                {
                    academy_id: 4,
                    academy_name: 'NFQ Academy',
                    academy_email: 'akademija@nfq.lt',
                    academy_url: 'wwww.nfq.lt/nfq-academy',
                    academy_logo: 'https://avatars0.githubusercontent.com/u/4995607?v=3&s=100',
                    description: 'Super cool academy, with tons of homeworks',
                    price: false
                }
            ]
        ), 1000)
    })*/
}
