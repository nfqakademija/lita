import React, { Component } from 'react';
import { getAcademies } from "../services/api";
import List from './List';

class App extends Component {

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

    render() {
        const { academies } = this.state;
        return (
            <div className="container">
                <div className="row">
                    <List academies={academies} />
                </div>
            </div>
        );
    }
}

export default App;