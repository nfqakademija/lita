import React, { PureComponent } from 'react';
import 'bootstrap/js/dist/dropdown';
import './filters.scss';
import PropTypes from "prop-types";

class Filters extends PureComponent {

    constructor(props){
        super(props);
        this.state = {
            selectedCity: null,
            selectedProgram: null,
            selectedPrice: null,
        };
    }

    setCityFilter = (event) => {
        this.setState({
            selectedCity: event.currentTarget.innerHTML === "&nbsp;" ? null : event.currentTarget.innerHTML
        });
    };

    setProgramFilter = (event) => {
        this.setState({
            selectedProgram: event.currentTarget.innerHTML === "&nbsp;" ? null : event.currentTarget.innerHTML
        });
    };

    setPriceFilter = (event) => {
        this.setState({
            selectedPrice: event.currentTarget.innerHTML === "&nbsp;" ? null : event.currentTarget.innerHTML
        });
    };

    filter = () => {
        this.props.filterAcademies(
            this.state.selectedCity,
            this.state.selectedProgram,
            this.state.selectedPrice,
        )
    };

    render() {
        return (
            <div className="row pt-5">
                <label className="col-lg-2 col-12 filter-label">Filtruoti pagal:</label>
                <div className="col-lg-8 col-12 mb-3">
                    <div className="row">
                        <div className="col-12 col-lg-4 mb-3 dropdown show filter my-lg-auto">
                            <a className="btn dropdown-toggle filter-toggle mr-lg-3 w-100" href="#" role="button" id="dropdownMenuLinkCity"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                { this.state.selectedCity === null ? "Miestas" : this.state.selectedCity }
                            </a>

                            <div className="dropdown-menu" aria-labelledby="dropdownMenuLinkCity">
                                <span className="dropdown-item" onClick={this.setCityFilter}>&nbsp;</span>
                                <span className="dropdown-item" onClick={this.setCityFilter}>Vilnius</span>
                                <span className="dropdown-item" onClick={this.setCityFilter}>Kaunas</span>
                                <span className="dropdown-item" onClick={this.setCityFilter}>Šiauliai</span>
                            </div>
                        </div>
                        <div className="col-12 col-lg-4 mb-3 dropdown show filter my-lg-auto">
                            <a className="btn dropdown-toggle filter-toggle mr-lg-3 w-100" href="#" role="button" id="dropdownMenuLinkProgram"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                { this.state.selectedProgram === null ? "Programa" : this.state.selectedProgram }
                            </a>

                            <div className="dropdown-menu" aria-labelledby="dropdownMenuLinkProgram">
                                <span className="dropdown-item" onClick={this.setProgramFilter}>&nbsp;</span>
                                <span className="dropdown-item" onClick={this.setProgramFilter}>Front-End programuotojas</span>
                                <span className="dropdown-item" onClick={this.setProgramFilter}>Back-End programuotojas</span>
                                <span className="dropdown-item" onClick={this.setProgramFilter}>Testuotojas</span>
                            </div>
                        </div>
                        <div className="col-12 col-lg-4 mb-3 dropdown show filter my-lg-auto">
                            <a className="btn dropdown-toggle filter-toggle mr-lg-3 w-100" href="#" role="button" id="dropdownMenuLinkPrice"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                { this.state.selectedPrice === null ? "Kaina" : this.state.selectedPrice }
                            </a>

                            <div className="dropdown-menu" aria-labelledby="dropdownMenuLinkPrice">
                                <span className="dropdown-item" onClick={this.setPriceFilter}>&nbsp;</span>
                                <span className="dropdown-item" onClick={this.setPriceFilter}>Nemokama</span>
                                <span className="dropdown-item" onClick={this.setPriceFilter}>Pigiausios viršuje</span>
                                <span className="dropdown-item" onClick={this.setPriceFilter}>Brangiausios viršuje</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-lg-2 col-12 mb-3">
                    <button className="btn btn-blue ml-auto w-100" onClick={this.filter}>Filtruoti</button>
                </div>
            </div>
        );
    }
}

Filters.propTypes = {
    filterAcademies: PropTypes.func
};

export default Filters;
