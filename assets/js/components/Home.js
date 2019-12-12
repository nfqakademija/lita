import React, { Component } from 'react';
import { getAcademies } from "../services/api";
import List from './List';

class Home extends Component {

    constructor(props){
        super(props);
        this.state = {
            academies: [],
        }
    }

    async componentDidMount() {
        const academies = await getAcademies();
        this.setState({ academies });
    }

    getAcademiesByFilter = async (city, program, price) => {
        console.log(city, program, price);
        const academies = await getAcademies();
        this.setState({ academies });
    };

    render() {
        const { academies } = this.state;
        return (
            <div className="container">
                <List academies={academies} filterAcademies={this.getAcademiesByFilter} />
            </div>
        );
    }
}

export default Home;
